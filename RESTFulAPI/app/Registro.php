<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Registro extends Model
{
    protected $fillable = [
        'id_planeta', 
        'id_usuario',
    ];

    public static function ContarRegistros($id)
    {
      
        return  DB::table('registros')->
                        select(DB::raw('count(*) as Visitantes'))->
                        where('id_planeta',$id)->get();
                    
    }

    public static function ListarUsuarios($id)
    {
        
        $dados =   DB::table('registros')->
                        select(DB::raw('id_usuario as Visitas'))->
                        where('id_planeta',$id)->get();
        foreach($dados as $dat =>$da){
            foreach($da as $d){
                $return[] = $d;
            }
        }                
        return $return;
    }

    public static function RankingPessoas(){

        return DB::table('registros')->
            select(array('id', DB::raw('COUNT(id_usuario) as Quantidade')))->
            join('users','registros.id_usuario','users.id')->
            groupBy('registros.id_usuario')->
            orderBy(DB::raw('COUNT(id_usuario)'),'desc')->get();

    }

    public static function AgruparPessoas(){

        $results = DB::table('registros')->
        select(DB::raw('id_planeta'))->groupBy('registros.id_planeta')->get();
        foreach ($results as $result) {
            foreach($result as $resul){
            $retorno = Registro::ListarUsuarios($resul);
      
            $data[] = [$resul => $retorno];
            }
        }
    
    return $data;
    }

}
