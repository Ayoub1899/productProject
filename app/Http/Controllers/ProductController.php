<?php


namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;

use Illuminate\Auth\Access\AuthorizationException;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;


class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            // Si l'utilisateur est un admin, il a accès à toutes les routes
            if (Auth::user()->role === 'admin') {
                return $next($request);
            }

            // Si l'utilisateur est un manager, il a accès à toutes les routes sauf 'delete'
            if (Auth::user()->role === 'manager' && !$request->routeIs('delete')) {
                return $next($request);
            }

            // Pour tous les autres cas, redirection avec message d'erreur
            return redirect('/')->with('error', 'Unauthorized access');
        });
    }

    /**
     * @throws AuthorizationException
     */
    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $this->authorize('viewAny', Product::class);

        $products = Product::simplePaginate(9);
        return view('index', compact('products'));
    }

    /**
     * @throws AuthorizationException
     */
    public function create(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {

        $this->authorize('create', Product::class);

        return view('create');

    }

    public function store(StoreProductRequest $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
            'image1' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image2' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imagesCount = count(array_filter([$request->file('image1'), $request->file('image2')]));
        if ($imagesCount != 2) {
            return redirect()->back()->withErrors(['images' => 'You must provide 2 images.']);
        }

        $input = $request->all();

        if (($image1 = $request->file('image1')) && ($image2 = $request->file('image2'))) {
            $destinationPath = 'images/';
            $profileImage1 = date('YmdHis') . "_1." . $image1->getClientOriginalExtension();
            $profileImage2 = date('YmdHis') . "_2." . $image2->getClientOriginalExtension();

            $image1->move($destinationPath, $profileImage1);
            $image2->move($destinationPath, $profileImage2);

            $input['image1'] = $profileImage1;
            $input['image2'] = $profileImage2;
        }

        Product::create($input);

        return redirect('/products');
    }

    public function edit(Product $product): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {

        return view('edit', compact('product'));
    }

    /**
     * @throws AuthorizationException
     */
    public function update(StoreProductRequest $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
        ]);

        $input = $request->all();

        if ($image1 = $request->file('image1')) {
            $destinationPath = 'images/';
            $profileImage1 = date('YmdHis') . "_1." . $image1->getClientOriginalExtension();
            $image1->move($destinationPath, $profileImage1);
            $input['image1'] = $profileImage1;
        } else {
            unset($input['image1']);
        }

        if ($image2 = $request->file('image2')) {
            $destinationPath = 'images/';
            $profileImage2 = date('YmdHis') . "_2." . $image2->getClientOriginalExtension();
            $image2->move($destinationPath, $profileImage2);
            $input['image2'] = $profileImage2;
        } else {
            unset($input['image2']);
        }

        $product->update($input);

        return redirect()->route('products')
            ->with('success', 'Produit édité avec succès');
    }

    /**
     * @throws AuthorizationException
     */
    public function show(Product $product): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $this->authorize('show', $product);

        return view('show', compact('product'));
    }

    /**
     * @throws AuthorizationException
     */
    public function destroy(Product $product): \Illuminate\Http\RedirectResponse
    {
        $this->authorize('delete', $product);

        $product->delete();

        return redirect()->route('products')
            ->with('success','Product supprimé avec succès');
    }
}
