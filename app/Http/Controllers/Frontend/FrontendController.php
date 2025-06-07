<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Reservation;
use App\Models\SectionTitle;
use App\Models\Slider;
use App\Models\WhyChooseUs;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View as FacadesView;
use Illuminate\Validation\ValidationException;

use Response;

class FrontendController extends Controller
{
    function index(): View
    {
        $contact = Contact::first();

        $sectionTitles = $this->getSectionTitle();

        $sliders = Slider::where('status', 1)->get();

        $whyChooseUs = WhyChooseUs::where('status', 1)->get();

        $categories = Category::where(['show_at_home' => 1, 'status' => 1,])->get();
        return View(
            'frontend.home.index',
            compact(
                'contact',
                'sliders',
                'sectionTitles',
                'whyChooseUs',
                'categories'
            )
        );
    }
    function getSectionTitle(): Collection
    {
        $keys = [
            'why_choose_top_title',
            'why_choose_main_title',
            'why_choose_sub_title'
        ];
        return SectionTitle::whereIn('key', $keys)->pluck('value', 'key');
    }

    function menu(Request $request): View
    {
        $products = Product::where(['status' => 1])->orderBy('id', 'DESC');

        if ($request->has('search') && $request->filled('search')) {
            $products->where(function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('long_description', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->has('category') && $request->filled('category')) {
            $products->whereHas('category', function ($query) use ($request) {
                $query->where('slug', $request->category);
            });
        }

        $products = $products->paginate(20);

        $categories = Category::where('status', 1)->get();
        return view('frontend.pages.menu', compact('products', 'categories'));
    }

    function showProduct(string $slug): View
    {
        $product = Product::with(['productImages', 'productSizes', 'productOptions'])->where([
            'slug' => $slug,
            'status' => 1
        ])->firstOrFail();
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)->take(8)->latest()->get();

        return view('frontend.pages.product-view', compact('product', 'relatedProducts'));
    }

    function loadProductModal($productId)
    {
        $product = Product::with(['productSizes', 'productOptions'])->findOrFail($productId);

        return view('frontend.layouts.ajax-files.product-popup-modal', compact('product'))->render();
    }

   public function about()
{
    $categories = Category::all();
    $products = Product::paginate(8); // Get paginated products

    return view('frontend.pages.about', compact('categories', 'products'));
}

    function contact() : View {
        $contact = Contact::first();
        return view('frontend.pages.contact', compact('contact'));
    }

    function reservation(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => ['required', 'max:255'],
            'phone' => ['required', 'max:50'],
            'date' => ['required', 'date'],
            'time' => ['required'],
            'persons' => ['required', 'numeric'],
        ]);

        if (!Auth::check()) {
            throw ValidationException::withMessages(['Please Login to Request Reservation']);
        }
        $reservation = new Reservation();
        $reservation->reservation_id = rand(0, 500000);
        $reservation->user_id = auth()->user()->id;
        $reservation->name = $request->name;
        $reservation->phone = $request->phone;
        $reservation->date = $request->date;
        $reservation->time = $request->time;
        $reservation->persons = $request->persons;
        $reservation->status = 'pending';
        $reservation->save();

        return response(['status' => 'success', 'message' => 'Request send successfully!']);
    }
}
