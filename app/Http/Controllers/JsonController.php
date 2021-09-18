<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Diagnosa;
use App\Models\Jawaban;
use App\Models\Rule;
use App\Models\Master;
use App\Models\Hasil;
use DB;
use App\Models\Tanya;
use App\Models\Jawab;
use Illuminate\Support\Facades\Http;
use App\Models\Article;

class JsonController extends Controller
{
    public function mulai_diag()
    {
        $diag = Diagnosa::create();
        return response()->json($diag->id);
    }

    public function isi($id)
    {
        $diag = Diagnosa::find($id);
        if ($diag) {
            $diag = Diagnosa::find($id);
            $tanya = Tanya::all();
            $jawab = Jawab::all();
            return response()->json(
                [
                    'diag' => $diag,
                    'pertanyaan' => $tanya,
                    'pilihan_jawaban' => $jawab,
                ]
            );
        } else {
            return response()->json(['msg' => 'ID tidak ada']);
        }
    }

    public function store(Request $request, $id)
    {
        $tanya = Tanya::all();
        $diag = Diagnosa::find($id);

        DB::beginTransaction();
        try {
            $index = 0;
            foreach ($tanya as $item) {
                Jawaban::create([
                    'tanya_id' => $request->tanya_id[$index],
                    'jawab_id' => $request->jawab_id[$index],
                    'diagnosa_id' => $diag->id,
                ]);
    
                $index+=1;
            }
    
            $diags = Diagnosa::with('jawaban')->find($id);
            $rule = Rule::with('master')->get();
    
            $hasil = "";
            foreach ($diags->jawaban as $item) {
                $hasil .= $item->tanya_id.$item->jawab_id;
            }
    
            $rules = [];
            foreach ($rule as $item) {
                $master = "";
                foreach ($item->master as $items) {
                    $master .= $items->tanya_id.$items->jawab_id;
                }
    
                $rules[] = ([
                    'rule_id' => $item->id,
                    'array' => $master,
                ]);
            }
    
            foreach ($rules as $cek) {
                if ($cek['array'] == $hasil) {
                    $hasil = Hasil::create([
                        'diagnosa_id' => $diags->id,
                        'rule_id' => $cek['rule_id'],
                    ]);

                    $result = Diagnosa::with('hasil.rule.solusi.item')->find($diags->id);
                    if (empty($diag->hasil)) {
                        return response()->json(['msg' => 'Rule tidak ditemukan']);
                    } else {
                        return response()->json($result);
                    }
                    DB::commit();
                    return "rules ada";
                    break;
                }
            }

            
                
        } catch(\Exception $e) {
            DB::rollback();
            return response()->json(['msg' => 'Diagnosis gagal']);
        }
        
    }

    public function nearest(Request $request)
    {
        $latlon = $request->cari;
        $split = explode(',', $latlon);
        $lat = $split[0];
        $lon = $split[1];
        $hospitals          =       DB::table("hospitals");
        $hospitals          =       $hospitals->select("*", DB::raw("6371 * acos(cos(radians(" . $lat . "))
                                * cos(radians(latitude)) * cos(radians(longitude) - radians(" . $lon . "))
                                + sin(radians(" .$lat. ")) * sin(radians(latitude))) AS distance"));
        $hospitals          =       $hospitals->having('distance', '<', 10);
        $hospitals          =       $hospitals->orderBy('distance', 'asc');

        $hospitals          =       $hospitals->get();
        
        return response()->json($hospitals);
    }

    public function statistik()
    {
        $response = Http::get('https://api.kawalcorona.com/indonesia');
        $data = $response->json();
        $vars = (object)array(
            'positif' => $data[0]["positif"],
            'sembuh' => $data[0]["sembuh"],
            'meninggal' => $data[0]["meninggal"],
            'dirawat' => $data[0]["dirawat"],
        );
        return response()->json($vars);
    }

    public function latest_article()
    {
        $article = Article::with('user')->latest()->take(4)->get();
        return response()->json($article);
    }

    public function article()
    {
        $article = Article::with('user')->latest()->get();
        return response()->json($article);
    }

    public function detail_article(Article $article)
    {
        $detail = $article->load('user');
        return response()->json($detail);
    }
}
