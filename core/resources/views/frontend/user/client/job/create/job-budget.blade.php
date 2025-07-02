<!-- Budget, Skills Start -->
<div class="setup-wrapper-contents">
    <div class="setup-wrapper-contents-item">
        <div class="setup-bank-form">
            <div class="setup-bank-form-item">
                <label class="label-title">{{ __('Job type') }}</label>
                <select class="form-control" name="type" id="type">
                    <option value="fixed" selected>{{ __('Fixed-Price (Pay a fixed amount for the job)') }}</option>
                    <option value="hourly">{{ __('Hourly Rate (Pay based on total hours worked for the job)') }}</option>
                </select>
            </div>

            <div class="setup-bank-form-item setup-bank-form-item-icon d-none manage-hourly-jobs">
                <label class="label-title">{{ __('Hourly Rate') }}</label>
                <input type="number" class="form--control" name="hourly_rate"
                    onkeyup="setTimeout(() => { if (this.value === '' || this.value <= 0) this.value = 1; if (this.value > 100000) this.value = 100000; }, 1500);"
                    id="hourly_rate" placeholder="{{ __('Enter Hourly Rate') }}">
                {{-- <span >{{ get_static_option('site_global_currency') ?? '' }}</span> --}}
                <span class="input-icon">{{ get_static_option('site_global_currency') ?? '' }}</span>
            </div>
            <div class="setup-bank-form-item d-none manage-hourly-jobs">
                <label class="label-title">{{ __('Estimated Hours') }}</label>
                <input type="number" class="form--control" name="estimated_hours"
                    onkeyup="setTimeout(() => { if (this.value === '' || this.value <= 0) this.value = 1; if (this.value > 100000) this.value = 100000; }, 1500);"
                    id="estimated_hours" placeholder="{{ __('Enter Estimated Hours') }}">
            </div>
            <div class="setup-bank-form-item setup-bank-form-item-icon manage-fixed-jobs">
                <label class="label-title">{{ __('Enter Budget') }}</label>
                <input type="number" class="form--control" name="budget" id="budget" value="0"
                    placeholder="{{ __('Enter Your Budget') }}">
                <span class="input-icon">{{ get_static_option('site_global_currency') ?? '' }}</span>
            </div>
            <x-form.skill-dropdown :title="__('Select Skill')" :name="'skill[]'" :id="'skill'" :class="'form-control skill_select2'" />
            <div class="setup-bank-form-item">
                <label class="photo-uploaded center-text w-100">
                    <div class="photo-uploaded-flex d-flex uploadImage">
                        <div class="photo-uploaded-icon"><i class="fa-solid fa-paperclip"></i></div>
                        <span class="photo-uploaded-para" id="attachmentText">{{ __('Add attachments') }}</span>
                        {{-- Optional: Add a clear button visible only when a file is selected --}}
                        <button type="button" class="btn btn-sm btn-light ml-2" id="clearAttachment"
                            style="display:none;">
                            <i class="fa-solid fa-times"></i> {{-- Font Awesome X icon --}}
                        </button>
                    </div>
                    <input class="photo-uploaded-file inputTag" type="file" name="attachment" id="attachment">
                </label>
                @if (get_static_option('file_extensions'))
                    <p class="mt-2">
                        {{ __('Supported files:') }}
                        {{ implode(', ', json_decode(get_static_option('file_extensions'), true)) }}
                    </p>
                @endif
            </div>

            {{-- Add an area to display selected filename --}}
            <div id="selectedFileNameDisplay" class="mt-2" style="display:none;">
                <span>{{ __('Selected file:') }} <strong id="fileName"></strong></span>
                <button type="button" class="btn btn-sm btn-danger ml-2" id="clearAttachmentButton">
                    <i class="fa-solid fa-trash-alt"></i> {{-- Font Awesome trash icon --}}
                    {{ __('Remove') }}
                </button>
            </div>
        </div>
    </div>
</div>
<!-- Budget, Skills Ends -->


<script>
    // $(document).on('change', '#attachment', function(){
    //         let uploadImage = document.querySelector(".uploadImage");
    //         let file = document.querySelector(".inputTag").files[0];
    //         if (uploadImage && file) {
    //             uploadImage.innerText = file.name;
    //         }
    //     });
    document.addEventListener('DOMContentLoaded', function() {
        const attachmentInput = document.getElementById('attachment');
        const attachmentText = document.getElementById('attachmentText');
        const clearAttachmentButton = document.getElementById('clearAttachmentButton');
        const selectedFileNameDisplay = document.getElementById('selectedFileNameDisplay');
        const fileNameSpan = document.getElementById('fileName');
        const originalAttachmentText = attachmentText.textContent; // Store original text

        function updateAttachmentDisplay() {
            if (attachmentInput.files.length > 0) {
                const fileName = attachmentInput.files[0].name;
                fileNameSpan.textContent = fileName;
                selectedFileNameDisplay.style.display = 'block'; // Show filename and remove button
                attachmentText.style.display = 'none'; // Hide "Add attachments" text
            } else {
                fileNameSpan.textContent = '';
                selectedFileNameDisplay.style.display = 'none'; // Hide filename and remove button
                attachmentText.style.display = 'inline'; // Show "Add attachments" text
            }
        }

        // Listen for when a file is selected
        attachmentInput.addEventListener('change', updateAttachmentDisplay);

        // Listen for when the clear button is clicked
        clearAttachmentButton.addEventListener('click', function() {
            attachmentInput.value = ''; // Clear the selected file
            updateAttachmentDisplay(); // Update the display
        });

        // Initial check in case there's a pre-filled value (less common for file inputs)
        updateAttachmentDisplay();
    });

</script>
