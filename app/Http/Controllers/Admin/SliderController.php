<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\SliderDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SliderCreateRequest;
use App\Http\Requests\Admin\SliderUpdateRequest;
use App\Models\Slider;
use App\Traits\FileUploadTrait;
use Illuminate\Support\Facades\File;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    use FileUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(SliderDataTable $dataTable)
    {
        return $dataTable->render('admin.slider.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     */

    //(SliderCreateRequest $request): This indicates that the method expects an instance of the SliderCreateRequest class as a parameter named $request.
    //SliderCreateRequest is a custom form request class that contains validation rules for the data being submitted.
    public function store(SliderCreateRequest $request)
    {
        // dd($request->all();

        //HANDLE IMAGE UPLOAD
        $imagePath = $this->uploadImage($request, 'image');

        //create new slider model object
        $slider = new Slider();
        $slider->image = $imagePath;
        $slider->offer = $request->offer;
        $slider->title = $request->title;
        //$slider->sub_title = $request->sub_title;
        $slider->short_description = $request->short_description;
       // $slider->button_link = $request->button_link;
        $slider->status = $request->status;
        $slider->save();

        toastr()->success('Created Successfully!');

        return to_route('admin.slider.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $slider = Slider::findOrFail($id);

        //The findOrFail() method attempts to find a record by its primary key (usually 'id'), and if it cannot find the record,
        //user will be directed to 404 page.
        //The retrieved slider record is assigned to the $slider variable.

        return view('admin.slider.edit', compact('slider'));

        //The compact('slider') function is used to compact the $slider variable into an associative array,
        //which is then passed to the view.
        //This allows the view to access the $slider variable.
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SliderUpdateRequest $request, string $id): RedirectResponse
    {
        //dd($request->all());
        $slider = Slider::findOrFail($id);
        //IMAGE UPDATE
        $imagePath = $this->uploadImage($request, 'image', $slider->image);

        $slider->image = !empty($imagePath) ? $imagePath : $slider->image; //this line says: assign image to image path column.
        //if $imagePath variable is not empty (aka. not NULL) then assign path to $imagePath. But if it's empty assign path to currentPath.
        //why do this? because if we only put $slider->image = $imagePath; and the imagePath is NULL (because user didn't select any image)
        //it will throw an error. image cant be NULL here.

        $slider->offer = $request->offer;
        $slider->title = $request->title;
       // $slider->sub_title = $request->sub_title;
        $slider->short_description = $request->short_description;
        //$slider->button_link = $request->button_link;
        $slider->status = $request->status;
        $slider->save();

        toastr()->success('Updated Successfully!');

        return to_route('admin.slider.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $slider = Slider::findOrFail($id);
            if (File::exists(public_path($slider->image))) {
                File::delete(public_path($slider->image));
            }
            $slider->delete();
            return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
        } catch (\Exception $e) {
            return response(['status' => 'error', 'message' => 'Something went wrong!']);
        }
    }
}
