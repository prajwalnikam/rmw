<?php

namespace App\Http\Controllers\Frontend\Freelancer;

use App\Http\Controllers\Controller;
use App\Models\JobPost;
use App\Models\JobProposal;
use App\Models\Resource; // <--- Add this line
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Subscription\Entities\UserSubscription;

class ProposalController extends Controller
{
    public function all_proposal()
    {
        $all_proposals = JobProposal::with('job')
            ->where('freelancer_id',auth()->user()->id)
            ->latest()
            ->whereHas('job.job_creator')
            ->paginate(10); // Or whatever pagination you're using

        // --- Start: Logic to load attached resources for each proposal ---
        $allAttachedResourceIds = [];
        foreach ($all_proposals as $proposal) {
            // Ensure attached_resource_ids is an array (thanks to $casts in model) and not empty
            if (!empty($proposal->attached_resource_ids) && is_array($proposal->attached_resource_ids)) {
                $allAttachedResourceIds = array_merge($allAttachedResourceIds, $proposal->attached_resource_ids);
            }
        }
        // Get unique IDs to avoid redundant fetching
        $allAttachedResourceIds = array_unique($allAttachedResourceIds);

        $attachedResources = collect();
        if (!empty($allAttachedResourceIds)) {
            // Fetch all unique resources in one query and key them by ID for easy lookup
            $attachedResources = Resource::whereIn('id', $allAttachedResourceIds)->get()->keyBy('id');
        }

        // Attach the actual resource objects to each proposal model
        foreach ($all_proposals as $proposal) {
            $proposal->loaded_attached_resources = collect(); // Initialize an empty collection

            if (!empty($proposal->attached_resource_ids) && is_array($proposal->attached_resource_ids)) {
                foreach ($proposal->attached_resource_ids as $resourceId) {
                    if ($attachedResources->has($resourceId)) {
                        $proposal->loaded_attached_resources->push($attachedResources->get($resourceId));
                    }
                }
            }
        }
        // --- End: Logic to load attached resources ---

        $jobs = JobPost::with('job_creator','job_skills')
            ->whereHas('job_creator')
            ->where('on_off','1')
            ->where('status','1')
            ->where('job_approve_request','1')
            ->latest()
            ->take(5)->get();

        return view('frontend.user.freelancer.proposal.proposals',compact(['all_proposals','jobs']));
    }

    // You should apply similar logic to your pagination method if you also want to display
    // attached resources on subsequent pages loaded via AJAX.
    function pagination(Request $request)
    {
        if($request->ajax()){
            $all_proposals = JobProposal::with('job')
                ->where('freelancer_id',auth()->user()->id)
                ->latest()
                ->paginate(10);

            // --- Start: Duplicate Logic for AJAX Pagination (if needed) ---
            $allAttachedResourceIds = [];
            foreach ($all_proposals as $proposal) {
                if (!empty($proposal->attached_resource_ids) && is_array($proposal->attached_resource_ids)) {
                    $allAttachedResourceIds = array_merge($allAttachedResourceIds, $proposal->attached_resource_ids);
                }
            }
            $allAttachedResourceIds = array_unique($allAttachedResourceIds);

            $attachedResources = collect();
            if (!empty($allAttachedResourceIds)) {
                $attachedResources = Resource::whereIn('id', $allAttachedResourceIds)->get()->keyBy('id');
            }

            foreach ($all_proposals as $proposal) {
                $proposal->loaded_attached_resources = collect();
                if (!empty($proposal->attached_resource_ids) && is_array($proposal->attached_resource_ids)) {
                    foreach ($proposal->attached_resource_ids as $resourceId) {
                        if ($attachedResources->has($resourceId)) {
                            $proposal->loaded_attached_resources->push($attachedResources->get($resourceId));
                        }
                    }
                }
            }
            // --- End: Duplicate Logic for AJAX Pagination ---

            return view('frontend.user.freelancer.proposal.search-result', compact(['all_proposals']))->render();
        }
    }
}