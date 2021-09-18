<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tanya;
use App\Models\Diagnosa;
use App\Models\Jawaban;
use App\Models\Rule;
use App\Models\Master;
use App\Models\Hasil;
use DB;


class JawabanController extends Controller
{
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
                    Hasil::create([
                        'diagnosa_id' => $diags->id,
                        'rule_id' => $cek['rule_id'],
                    ]);
                    DB::commit();
                    $result = Diagnosa::with('hasil.rule.solusi.item')->find($diags->id);
                    if (empty($diag->hasil)) {
                        return response()->json(['msg' => 'Rule tidak ditemukan']);
                    } else {
                        return response()->json($result);
                    }
                    break;
                }
            }

            
                
        } catch(\Exception $e) {
            DB::rollback();
            return 'gagal';
        }
        
    }

    public function stosre(Request $request, $id)
    {
        $tanya = Tanya::all();
        $diag = Diagnosa::find($id);

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
                    // Hasil::create([
                    //     'diagnosa_id' => $diags->id,
                    //     'rule_id' => $cek['rule_id'],
                    // ]);
                    
                    return "rules ada";
                    
                }

                
            }

        // return [$hasil,$rules];

        // DB::beginTransaction();
        // try {
            
    
        //     foreach ($rules as $cek) {
        //         if ($cek['array'] === $hasil) {
        //             Hasil::create([
        //                 'diagnosa_id' => $diags->id,
        //                 'rule_id' => $cek['rule_id'],
        //             ]);
        //             DB::commit();
        //             return redirect()->route('dashboard');
        //             // break;
        //         } 

        //         else {
        //             return redirect()->route('dashboard');
        //         }
        //     }

            
                
        // } catch(\Exception $e) {
        //     DB::rollback();
        //     return 'gagal';
        // }
        
    }
}
