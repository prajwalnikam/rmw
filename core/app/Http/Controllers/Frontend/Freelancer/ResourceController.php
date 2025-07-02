<?php 
namespace App\Http\Controllers\Frontend\Freelancer;
use App\Imports\ResourceImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Resource;
use Illuminate\Support\Facades\Storage;
use illuminate\Support\Facades\Log;

class ResourceController extends Controller
{
    public function add()
    {
        // dd("helo");
        // log::info('Create resource function gets called1212');
        return view('frontend.user.freelancer.resources.add-resources');
    }
    public function import(Request $request)
    {
        // dd("helo");
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);
    
        Excel::import(new ResourceImport, $request->file('file'));
    
        return back()->with('success', 'Resources imported successfully!');
    }
    public function store(Request $request)
{
    $role = $request->role == 'Other' ? $request->custom_role : $request->role;

    $resource = new Resource();
    $resource->title = $request->title;
    $resource->description = $request->description;
    $resource->status = $request->status;
    $resource->role = $role;
    $resource->specification = $request->specification;
    $resource->experience = $request->experience;
    $resource->monthly_salary = $request->monthly_salary;
    $resource->hourly_salary = $request->hourly_salary;
    $resource->user_id = auth()->id();
    $resource->save();

    // Redirect back with success message
    return redirect()->back()->with('success', 'Resource saved successfully!');
}
    public function index()
{
    $resources = Resource::where('user_id', auth()->id())->paginate(20);
    return view('frontend.user.freelancer.resources.all-resources', compact('resources'));
}

    public function update(Request $request)
    {
        $resource = Resource::findOrFail($request->id);
        // dd('helsknds');
        // // Validate the request data
        // $request->validate([
        //     'title' => 'required|string|max:255',
        //     'description' => 'nullable|string|max:255',
        //     'status' => 'required|in:1,0',
        //     'role' => 'required|string',
        //     'custom_role' => 'nullable|string|max:255',
        //     'specification' => 'nullable|string|max:255',
        //     'experience' => 'required|string',
        //     'monthly_salary' => 'nullable|numeric',
        //     'hourly_salary' => 'nullable|numeric',
        // ]);

        // Determine the role
        $role = $request->role === 'Other' ? $request->custom_role : $request->role;

        // Update the resource
        $resource->title = $request->title;
        $resource->description = $request->description;
        // $resource->status = $request->status;
        $resource->role = $role;
        $resource->specification = $request->specification;
        $resource->experience = $request->experience;
        $resource->monthly_salary = $request->monthly_salary;
        $resource->hourly_salary = $request->hourly_salary;
        $resource->save();
        return redirect()->back()->with('success', 'Resource updated successfully!');
        // return redirect('/freelancer/resource/all')->with('success', 'Resource updated successfully.');
        // return redirect()->route('freelancer.resource.index')->with('success', 'Resource updated successfully.');
        // Redirect or return a response
        // return redirect()->route('freelancer.resources.index')->with('success', 'Resource updated successfully.');
        // return redirect()->back()->with('success', 'Resource updated successfully.');
        // return view('frontend.user.freelancer.resources.all-resources', compact('resources'));
    }

    public function destroy(Request $request)
    {
        // dd('helo'); 
        $resource = Resource::findOrFail($request->id);
        $resource->delete();

            return redirect()->back()->with('success', 'Resource deleted successfully!');
        // return redirect()->route('freelancer.resource.index')->with('success', 'Resource deleted successfully.');
        // $resources = Resource::where('user_id', auth()->id())->get();
        // return view('frontend.user.freelancer.resources.all-resources', compact('resources'));
    }

    public function updateStatus(Request $request)
    {
        // dd('hfhfh');
        $resource = Resource::findOrFail($request->id);
        $resource->status = $request->status;
        $resource->save();

        return redirect()->back()->with('success', 'Resource status updated successfully!');
        // return redirect()->route('freelancer.resource.index')->with('success', 'Resource status updated successfully.');
        // return view('frontend.user.freelancer.resources.all-resources', compact('resources'));
    }
}