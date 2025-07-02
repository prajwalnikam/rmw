<?php


namespace plugins\PageBuilder\Addons\Project;

use App\Models\JobPost;
use App\Models\Project;
use App\Models\User;
use Carbon\Carbon;
use Modules\Service\Entities\Category;
use plugins\PageBuilder\Fields\ColorPicker;
use App\Service;
use plugins\PageBuilder\Fields\Slider;
use plugins\PageBuilder\Fields\Number;
use plugins\PageBuilder\Fields\Text;
use plugins\PageBuilder\PageBuilderBase;
use plugins\PageBuilder\Traits\LanguageFallbackForPageBuilder;
use plugins\PageBuilder\Fields\Select;


class ExploreCategoryProject extends PageBuilderBase
{
    use LanguageFallbackForPageBuilder;

    public function preview_image()
    {
        return 'home-page/category-project-explore.png';
    }

    public function admin_render()
    {
        $output = $this->admin_form_before();
        $output .= $this->admin_form_start();
        $output .= $this->default_fields();
        $widget_saved_values = $this->get_settings();
        $categories = Category::where('status',1)
            ->pluck('category','id')->toArray();


        $output .= Text::get([
            'name' => 'title',
            'label' => __('Title'),
            'value' => $widget_saved_values['title'] ?? null,
            'info' => __('This title will be prefixed with the category name.'),
        ]);

        $output .= Select::get([
            'name' => 'category',
            'label' => __('Select Category'),
            'options' => $categories,
            'value' => $widget_saved_values['category'] ?? null,
            'info' => __('set category')
        ]);

        $output .= Number::get([
            'name' => 'items',
            'label' => __('Items'),
            'value' => $widget_saved_values['items'] ?? null,
            'info' => __('Enter how many item you want to show in frontend.'),
        ]);

        $output .= Text::get([
            'name' => 'view_all',
            'label' => __('View All Text'),
            'value' => $widget_saved_values['view_all'] ?? null,
        ]);

        $output .= Text::get([
            'name' => 'view_all_link',
            'label' => __('View All Link'),
            'value' => $widget_saved_values['view_all_link'] ?? null,
        ]);

        $output .= Slider::get([
            'name' => 'padding_top',
            'label' => __('Padding Top'),
            'value' => $widget_saved_values['padding_top'] ?? 260,
            'max' => 500,
        ]);

        $output .= Slider::get([
            'name' => 'padding_bottom',
            'label' => __('Padding Bottom'),
            'value' => $widget_saved_values['padding_bottom'] ?? 190,
            'max' => 500,
        ]);
        $output .= ColorPicker::get([
            'name' => 'section_bg',
            'label' => __('Background Color'),
            'value' => $widget_saved_values['section_bg'] ?? null,
            'info' => __('select color you want to show in frontend'),
        ]);

        $output .= $this->admin_form_submit_button();
        $output .= $this->admin_form_end();
        $output .= $this->admin_form_after();

        return $output;
    }


    public function frontend_render()
    {
        $settings = $this->get_settings();
        $title =    $settings['title'];
        $items =    $settings['items'] ?? 5;
        $category_id = $settings['category'] ?? '';
        $view_all_text = $settings['view_all'] ?? '';
        $view_all_link = $settings['view_all_link'] ?? '';
        $padding_top = $settings['padding_top'] ?? '';
        $padding_bottom = $settings['padding_bottom'] ?? '';
        $section_bg = $settings['section_bg'] ?? '';
        if($category_id){
            $category = Category::select('id','category','status')->where('status',1)->where('id',$category_id)->first();
        }
        $explore_projects = Project::select('id', 'title','slug','user_id','basic_regular_charge','basic_discount_charge','basic_delivery','description','image','load_from')
            ->where('project_on_off','1')
            ->where('status','1')
            ->where('category_id',$category?->id)
            ->whereHas('project_creator')
            ->take($items)->inRandomOrder()->get();

        return  $this->renderBlade('projects.explore-category-projects',compact(['title','items','category','view_all_text','view_all_link','padding_top','padding_bottom','section_bg','explore_projects']));
    }

    public function addon_title()
    {
        return __('Explore Category Project: 01');
    }
}
