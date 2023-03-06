<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CustomMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        //obtener el token en solicitud
        $token = $request->bearerToken();
        //validamos la estructura (abrir cerrar con el mismo tipo)
        $validToken = $this->validateStructure($token);
        if(!$validToken){
            return response()->json(['error' => 'No autorizado'], 401);
        }        
        return $next($request);
    }

    public function validateStructure($token){
        $open = "([{";
        $close = ")]}";
        
        $compare = array(
            ")" => "(",
            "]" => "[",
            "}" => "{"
        );
        
        $pila = [];
        $token = str_split($token);
        
        foreach($token as $caracter){
        
            if (str_contains($open,$caracter)){
                array_push($pila,$caracter);
            } elseif(str_contains($close,$caracter)){
                if (count($pila) == 0){
                    return False;
                }
        
                if ($pila[count($pila) - 1] == $compare[$caracter]){ // Comparación
                    array_pop($pila);
                } else {
                    return False;        
                }
            }
        }
          
        return count($pila) == 0;
    }
}
