<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\JobPost;
use App\Models\JobProposal;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Modules\Subscription\Entities\Subscription;
use Modules\Subscription\Entities\UserSubscription;
use App\Models\Resource;
use Illuminate\Support\Facades\DB; 

class JobDetailsController extends Controller
{
    public function job_details($username = null , $slug = null)
    {
        if (Auth::check()){
            $user=Auth::user();
        }
        $job_details = JobPost::with(['job_creator','job_skills','job_proposals'])->where('slug',$slug)->first();
        $resources = $user->resources()->where('status','1')->get();
        // dd($resources);
        if(!empty($job_details)){
            $user = User::with('user_country')->where('id',$job_details->user_id)->first();
            return view('frontend.pages.job-details.job-details',compact('job_details','user', 'resources'));
        }
        return back();
    }

    //job proposal
    // public function job_proposal_send(Request $request)
    // {
    //     // $request->validate([
    //     //     'client_id'=>'required',
    //     //     'amount'=>'required|numeric|gt:0',
    //     //     'duration'=>'required',
    //     //     'revision'=>'required|min:0|max:100',
    //     //     'cover_letter'=>'required|min:10|max:1000',
    //     // ]);

    //     // $freelancer_id = Auth::guard('web')->user()->id;
    //     // $check_freelancer_proposal = JobProposal::where('freelancer_id',$freelancer_id)->where('job_id',$request->job_id)->first();
    //     // if($check_freelancer_proposal){
    //     //     return back()->with(toastr_warning(__('You can not send one more proposal.')));
    //     // }
    //     // if(Auth::guard('web')->user()->is_suspend == 1){
    //     //     return back()->with(toastr_warning(__('You can not send job proposal because your account is suspended. please try to contact admin')) );
    //     // }

    //     // // if(get_static_option('subscription_enable_disable') != 'disable'){
    //     //     $freelancer_subscription = UserSubscription::select(['id','user_id','limit','expire_date','created_at'])
    //     //         ->where('payment_status','complete')
    //     //         ->where('status',1)
    //     //         ->where('user_id',$freelancer_id)
    //     //         ->where("limit", '>=', get_static_option('limit_settings'))
    //     //         ->whereDate('expire_date', '>', Carbon::now())->first();
    //     //     $total_limit = UserSubscription::where('user_id',$freelancer_id)->where('payment_status','complete')->whereDate('expire_date', '>', Carbon::now())->sum('limit');
    //     //     if($total_limit >= get_static_option('limit_settings') ?? 2 && !empty($freelancer_subscription)){
    //     //         $attachment_name = '';

    //     //         $upload_folder = 'jobs/proposal';
    //     //         $storage_driver = Storage::getDefaultDriver();
    //     //         $extensions = array('png','jpg','jpeg','bmp','gif','tiff','svg');

    //     //         if (cloudStorageExist() && in_array(Storage::getDefaultDriver(), ['s3', 'cloudFlareR2', 'wasabi'])) {
    //     //             if ($attachment = $request->file('attachment')) {
    //     //                 $request->validate([
    //     //                     'attachment' => 'required|mimes:png,jpg,jpeg,bmp,gif,tiff,svg,csv,txt,xlx,xls,pdf,docx|max:2048',
    //     //                 ]);
    //     //                 $attachment_name = time() . '-' . uniqid() . '.' . $attachment->getClientOriginalExtension();
    //     //                 if(in_array($attachment->getClientOriginalExtension(), $extensions)){
    //     //                     add_frontend_cloud_image_if_module_exists($upload_folder, $attachment, $attachment_name,'public');
    //     //                 }else{
    //     //                     add_frontend_cloud_image_if_module_exists($upload_folder, $attachment, $attachment_name,'public');
    //     //                 }
    //     //             }
    //     //         }else{
    //     //             if ($attachment = $request->file('attachment')) {
    //     //                 $request->validate([
    //     //                     'attachment'=>'required|mimes:png,jpg,jpeg,bmp,gif,tiff,svg,csv,txt,xlx,xls,pdf,docx|max:2048',
    //     //                 ]);
    //     //                 $attachment_name = time().'-'.uniqid().'.'.$attachment->getClientOriginalExtension();

    //     //                 if(in_array($attachment->getClientOriginalExtension(), $extensions)){
    //     //                     $resize_full_image = Image::make($request->attachment)
    //     //                         ->resize(1000, 600);
    //     //                     $resize_full_image->save('assets/uploads/jobs/proposal' .'/'. $attachment_name);
    //     //                 }else{
    //     //                     $attachment->move('assets/uploads/jobs/proposal', $attachment_name);
    //     //                 }
    //     //             }
    //     //         }

    //     //         $proposal = JobProposal::create([
    //     //             'job_id'=>$request->job_id,
    //     //             'freelancer_id'=>auth()->user()->id,
    //     //             'client_id'=>$request->client_id,
    //     //             'amount'=>$request->amount,
    //     //             'duration'=>$request->duration,
    //     //             'revision'=>$request->revision,
    //     //             'cover_letter'=>$request->cover_letter,
    //     //             'attachment'=>$attachment_name,
    //     //             'load_from' => in_array($storage_driver,['CustomUploader']) ? 0 : 1, //added for cloud storage 0=local 1=cloud
    //     //         ]);
    //     //         client_notification($proposal->id,$request->client_id,'Proposal', __('You have a new job proposal'));

    //     //         UserSubscription::where('id',$freelancer_subscription->id)->update([
    //     //             'limit' => $freelancer_subscription->limit - (get_static_option('limit_settings') ?? 2)
    //     //         ]);

    //     //         return back()->with(toastr_success(__('Proposal successfully send')));
    //     //     }
    //     //     return back()->with(toastr_warning(__('You have not enough connect to apply.')));
    //     // // }else{
    //     //     $attachment_name = '';
    //     //     if ($attachment = $request->file('attachment')) {
    //     //         $request->validate([
    //     //             'attachment'=>'required|mimes:png,jpg,jpeg,bmp,gif,tiff,svg,csv,txt,xlx,xls,pdf|max:2048',
    //     //         ]);
    //     //         $attachment_name = time().'-'.uniqid().'.'.$attachment->getClientOriginalExtension();
    //     //         $extensions = array('png','jpg','jpeg','bmp','gif','tiff','svg');

    //     //         if(in_array($attachment->getClientOriginalExtension(), $extensions)){
    //     //             $resize_full_image = Image::make($request->attachment)
    //     //                 ->resize(1000, 600);
    //     //             $resize_full_image->save('assets/uploads/jobs/proposal' .'/'. $attachment_name);
    //     //         }else{
    //     //             $attachment->move('assets/uploads/jobs/proposal', $attachment_name);
    //     //         }
    //     //     }
    //     //     $proposal = JobProposal::create([
    //     //         'job_id'=>$request->job_id,
    //     //         'freelancer_id'=>auth()->user()->id,
    //     //         'client_id'=>$request->client_id,
    //     //         'amount'=>$request->amount,
    //     //         'duration'=>$request->duration,
    //     //         'revision'=>$request->revision,
    //     //         'cover_letter'=>$request->cover_letter,
    //     //         'attachment'=>$attachment_name,
    //     //     ]);
    //     //     client_notification($proposal->id,$request->client_id,'Proposal', __('You have a new job proposal'));
    //     //     return back()->with(toastr_success(__('Proposal successfully send')));
    //     // }
    //     $request->validate([
    //         'client_id' => 'required',
    //         'amount' => 'required|numeric|gt:0',
    //         // 'duration' => 'required',
    //         'revision' => 'required|min:0|max:100',
    //         'cover_letter' => 'required|min:10|max:1000',
    //     ]);

    //     $freelancer_id = Auth::guard('web')->user()->id;
    //     // $check_freelancer_proposal = JobProposal::where('freelancer_id', $freelancer_id)->where('job_id', $request->job_id)->first();
    //     // if ($check_freelancer_proposal) {
    //     //     return back()->with(toastr_warning(__('You cannot send more than one proposal.')));
    //     // }
    //     // if (Auth::guard('web')->user()->is_suspend == 1) {
    //     //     return back()->with(toastr_warning(__('You cannot send a job proposal because your account is suspended. Please contact the admin.')));
    //     // }
    //     $job_details = JobPost::find($request->job_id);
    //     $jduration = $job_details->duration;
    //     // Create a new job proposal
    //     $job_proposal = new JobProposal();
    //     $job_proposal->job_id = $request->job_id;
    //     $job_proposal->client_id = $request->client_id;
    //     $job_proposal->freelancer_id = $freelancer_id;
    //     $job_proposal->amount = $request->amount;
    //     $job_proposal->duration = $jduration;
    //     $job_proposal->revision = $request->revision;
    //     $job_proposal->cover_letter = $request->cover_letter;
    //     $job_proposal->save();

    //     return back()->with(toastr_success(__('Job proposal sent successfully.')));
    // }


    public function job_proposal_send(Request $request)
    {
        $request->validate([
            'client_id' => 'required',
            'job_id' => 'required|exists:job_posts,id',
            // 'amount' => 'required|numeric|gt:0',
            'revision' => 'required|integer|min:0', // Still the count of selected resources
            // 'cover_letter' => 'required|min:10|max:1000',
            'selected_resources' => 'nullable|array', // Array of selected resource IDs
            'selected_resources.*' => 'exists:resources,id', // Each ID must exist
            // 'attachment' => 'nullable|mimes:png,jpg,jpeg,bmp,gif,tiff,svg,csv,txt,xlx,xls,pdf,docx|max:2048', // If you still want file uploads
        ]);

        $freelancer_id = Auth::guard('web')->user()->id;

        // --- (Your existing pre-checks and subscription logic go here) ---
        $check_freelancer_proposal = JobProposal::where('freelancer_id', $freelancer_id)
                                                ->where('job_id', $request->job_id)
                                                ->first();
        if ($check_freelancer_proposal) {
            return back()->with(toastr_warning(__('You cannot send more than one proposal for this job.')));
        }

        if (Auth::guard('web')->user()->is_suspend == 1) {
            return back()->with(toastr_warning(__('You cannot send job proposal because your account is suspended. Please contact admin.')));
        }

        // Subscription/Connects Logic
        // if (get_static_option('subscription_enable_disable') != 'disable') {
        //     $freelancer_subscription = UserSubscription::select(['id','user_id','limit','expire_date','created_at'])
        //         ->where('payment_status','complete')
        //         ->where('status',1)
        //         ->where('user_id',$freelancer_id)
        //         ->where("limit", '>=', get_static_option('limit_settings'))
        //         ->whereDate('expire_date', '>', Carbon::now())->first();

        //     if (empty($freelancer_subscription)) {
        //         return back()->with(toastr_warning(__('You do not have enough connects to apply for this job or an active subscription.')));
        //     }
        // }
        // --- End of existing logic ---


        $job_details = JobPost::find($request->job_id);
        if (!$job_details) {
            return back()->with(toastr_error(__('Job not found.')));
        }
        $jduration = $job_details->duration;

        try {
            DB::beginTransaction();

            // Handle attachment if still needed (your existing logic)
            // ...

            // Filter selected resources to ensure they belong to the current freelancer
            $selectedResourceIds = [];
            if ($request->has('selected_resources') && is_array($request->selected_resources)) {
                $selectedResourceIds = Resource::where('user_id', $freelancer_id)
                                                ->whereIn('id', $request->selected_resources)
                                                ->pluck('id')
                                                ->toArray();
            }

            // Create a new job proposal
            $job_proposal = JobProposal::create([
                'job_id' => $request->job_id,
                'freelancer_id' => $freelancer_id,
                'client_id' => $request->client_id,
                'amount' => $request->amount,
                'duration' => $jduration,
                'revision' => $request->revision,
                'cover_letter' => $request->cover_letter,
                // 'attachment' => $attachment_name, // Uncomment if using attachment
                // 'load_from' => in_array($storage_driver,['CustomUploader']) ? 0 : 1, // Uncomment if using attachment
                'attached_resource_ids' => $selectedResourceIds, // Store the array directly! Laravel handles JSON encoding.
            ]);

            // Update Subscription Limit (if enabled)
            if (get_static_option('subscription_enable_disable') != 'disable' && !empty($freelancer_subscription)) {
                UserSubscription::where('id', $freelancer_subscription->id)->update([
                    'limit' => $freelancer_subscription->limit - (get_static_option('limit_settings') ?? 2)
                ]);
            }

            // Client Notification
            client_notification($job_proposal->id, $request->client_id, 'Proposal', __('You have a new job proposal'));

            DB::commit();

            return back()->with(toastr_success(__('Job proposal successfully sent with selected resources.')));

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Job Proposal Send Error: ' . $e->getMessage() . ' in ' . $e->getFile() . ' on line ' . $e->getLine());
            return back()->with(toastr_error(__('Failed to send job proposal. Please try again later.')));
        }
    }
}

