<?php

namespace App\Http\Controllers\Api;
use \Illuminate\Http\JsonResponse;
use \App\Http\Controllers\Controller;
use \App\Models\{VisitorType};
use \Illuminate\Http\Request;

class VisitorTypeController extends Controller
{
    public function show (Request $request): JsonResponse {

      $search = self::format($request->input('term', ''));
      $response = VisitorType::query()->when(
      $search,
      fn ($query) => $query->where('type', 'like', "%{$search}%"))->select('id', 'name')
      ->orderBy('type')
      ->paginate(10)
      ->toArray();

      return response()->json([
        'results' => array_map(fn($r) => [
        'id' => $r['uuid'],
        'text' => $r['type'],
      ], $response['data']),
      'pagination' => ['more' => $response['current_page'] < $response['last_page']],
    ]);
    }

      public static function format($frase)
      {
        $palavras = explode(" ", $frase);
        $pesquisa = '';
        $palavrasIgnorar = [','];

        foreach ($palavras as $palavra) {
          if (!in_array($palavra, $palavrasIgnorar))
            $pesquisa = $pesquisa . '%' . $palavra;
        }

        return $pesquisa;
      }
}
