<?php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $query = Product::query();

        // Фильтрация по категории
        if ($request->has('category') && $request->category) {
            $query->where('category', $request->category);
        }

        // Сортировка
        if ($request->has('sort') && $request->sort) {
            switch ($request->sort) {
                case 'price_asc':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_desc':
                    $query->orderBy('price', 'desc');
                    break;
                case 'newest':
                    $query->orderBy('created_at', 'desc');
                    break;
                case 'sale':
                    $query->where('is_on_sale', true);
                    break;
            }
        }

        // Пагинация товаров
        $products = $query->paginate(15);

        // Передаем данные в представление
        return view('home', [
            'products' => $products,
            'currentCategory' => $request->category,
            'currentSort' => $request->sort,
        ]);
    }
}
