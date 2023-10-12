<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;



use App\Models\Product;

class ProductsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function getAll()
    {
        return response()->json(Product::all());
    }

    public function getId(Request $request, $id)
    {
        return response()->json(Product::findOrFail($id)->fill($request->all()));
    }

    public function create(Request $request)
    {
        // Verifique se o arquivo foi enviado com sucesso
        if ($request->hasFile('image')) {
            $requestImage = $request->file('image');

            // Defina um nome único para o arquivo, por exemplo, usando o timestamp
            $requestName = time() . '.' . $requestImage->getClientOriginalName();

            // Mova o arquivo para o diretório de uploads dentro de public
            $requestImage->move('uploads', $requestName);

            // Crie o produto com o caminho relativo do arquivo
            Product::create([
                'name' => $request->input('name'),
                'value' => $request->input('value'),
                'description' => $request->input('description'),
                'image' => 'uploads/' . $requestName, // Caminho relativo para o arquivo
            ]);

            return response()->json(["message" => "Product Created"]);
        } else {
            return response()->json(["message" => "Image not uploaded"], 400);
        }
    }


    public function update(Request $request, $id)
    {
        $products = Product::findOrFail($id)->fill($request->all());
        $products->update();
        return response()->json(["message" => "Product Updated!", "Produto" => $products]);
    }


    public function delete(Request $request, $id)
    {
        $products = Product::findOrFail($id);
        $products->delete();
    }
}
