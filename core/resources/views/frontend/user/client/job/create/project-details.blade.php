<!-- About Job Start -->
<div class="setup-wrapper-contents active">
    <div class="setup-wrapper-contents-item">
        <div class="setup-bank-form">
            <x-form.text :title="__('Project Title')" :type="'text'" :id="'project_name'" :name="'project_name'" :divClass="'mb-0'" :class="'form--control'" :value="old('title')" :placeholder="__('e.g. I need  landing page')" />
            <span id="job_title_char_length_check"></span>
            <label class="label-title" style="margin-top:20px;">{{ __('Project Description') }}</label>

            <x-form.summernote
                :title="__('Write a project description')"
                :name="'project_description'"
                :id="'project_description'"
                :rows="'10'" :cols="30"
                :value="old('project_description')"
                :class="'description '"
            />
            <span id="job_description_char_length_check"></span>

        </div>
    </div>
</div>
<!-- About Job Ends -->
