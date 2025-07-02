<script>
(function($){
    "use strict";

    pre_next();

    $(document).ready(function(){

        // Set up CSRF token for AJAX
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Initialize select2 dropdowns
        $('.category_select2, .subcategory_select2, .skill_select2').select2();

        // Hide subcategory section initially
        $('#subcategory_info').hide();

        // On category change, load subcategories
        $(document).on('change', '#category', function() {
            let category = $(this).val();
            $('#subcategory_info').show();

            $.ajax({
                method: 'post',
                url: "{{ route('au.subcategory.all') }}",
                data: { category: category },
                success: function(res) {
                    if (res.status === 'success') {
                        let options = "<option value=''>{{ __('Select Sub Category') }}</option>";
                        $.each(res.subcategories, function(index, value) {
                            options += `<option value="${value.id}">${value.sub_category}</option>`;
                        });
                        $(".get_subcategory").html(options);

                        if(res.subcategories.length <= 0){
                            $("#subcategory_info").html('<span class="text-danger">{{ __('No sub categories found for selected category!') }}</span>');
                        } else {
                            $("#subcategory_info").html('');
                        }
                    }
                }
            });
        });

        // Title length check
        $('#job_title_char_length_check').hide();
        $('#title').on('input', function(){
            $('#job_title_char_length_check').show();
            const minLen = 5;
            const maxLen = 100;
            const length = $(this).val().length;

            if(length < minLen){
                $('#job_title_char_length_check').html(`<p class="text-danger">{{ __('Length is short, minimum') }} ${minLen} {{ __('required') }}.</p>`);
            } else if(length > maxLen){
                $('#job_title_char_length_check').html(`<p class="text-danger">{{ __('Length is not valid, maximum') }} ${maxLen} {{ __('allowed') }}.</p>`);
            } else {
                $('#job_title_char_length_check').html(`<p class="text-success">{{ __('Length is valid') }}</p>`);
            }
        });

        // Slug generation
        function transliterateCyrillic(text) {
            const cyrillicToLatinMap = {
                'А': 'A', 'а': 'a', 'Б': 'B', 'б': 'b', 'В': 'V', 'в': 'v',
                'Г': 'G', 'г': 'g', 'Д': 'D', 'д': 'd', 'Е': 'E', 'е': 'e',
                'Ё': 'Yo', 'ё': 'yo', 'Ж': 'Zh', 'ж': 'zh', 'З': 'Z', 'з': 'z',
                'И': 'I', 'и': 'i', 'Й': 'Y', 'й': 'y', 'К': 'K', 'к': 'k',
                'Л': 'L', 'л': 'l', 'М': 'M', 'м': 'm', 'Н': 'N', 'н': 'n',
                'О': 'O', 'о': 'o', 'П': 'P', 'п': 'p', 'Р': 'R', 'р': 'r',
                'С': 'S', 'с': 's', 'Т': 'T', 'т': 't', 'У': 'U', 'у': 'u',
                'Ф': 'F', 'ф': 'f', 'Х': 'Kh', 'х': 'kh', 'Ц': 'Ts', 'ц': 'ts',
                'Ч': 'Ch', 'ч': 'ch', 'Ш': 'Sh', 'ш': 'sh', 'Щ': 'Shch', 'щ': 'shch',
                'Ъ': '', 'ъ': '', 'Ы': 'Y', 'ы': 'y', 'Ь': '', 'ь': '',
                'Э': 'E', 'э': 'e', 'Ю': 'Yu', 'ю': 'yu', 'Я': 'Ya', 'я': 'ya'
                // Additional languages skipped for brevity
            };

            const arabicToLatinMap = {
                'ا': 'a', 'أ': 'a', 'إ': 'i', 'آ': 'aa', 'ب': 'b', 'ت': 't', 'ث': 'th',
                'ج': 'j', 'ح': 'h', 'خ': 'kh', 'د': 'd', 'ذ': 'dh', 'ر': 'r', 'ز': 'z',
                'س': 's', 'ش': 'sh', 'ص': 's', 'ض': 'd', 'ط': 't', 'ظ': 'dh', 'ع': 'a',
                'غ': 'gh', 'ف': 'f', 'ق': 'q', 'ك': 'k', 'ل': 'l', 'م': 'm', 'ن': 'n',
                'ه': 'h', 'و': 'w', 'ي': 'y', 'ى': 'a', 'ة': 'h', 'ئ': 'e', 'ء': 'a',
                'ؤ': 'o', 'لا': 'la'
            };

            const langMap = currentLang() === 'ar' ? arabicToLatinMap : cyrillicToLatinMap;
            return text.split('').map(char => langMap[char] || char).join('');
        }

        function convertToSlug(text) {
            return transliterateCyrillic(text)
                .toLowerCase()
                .trim()
                .replace(/\s+/g, '-');
        }

        function currentLang() {
            const lang = document.documentElement.lang;
            return lang === 'ar' ? 'ar' : 'cyr';
        }

        $('.full-slug-show').hide();
        $(document).on('keyup', '#title', function () {
            $('.full-slug-show').show();
            let slug = convertToSlug($(this).val());
            $('#slug').val(slug);
            let baseUrl = "{{ url('/') }}";
            $('.full-slug-show').text(`${baseUrl}/${slug}`);
        });

        $(document).on('click','.edit_job_slug',function(){
            $('.display_label_title').removeClass('d-none');
            $('#slug').removeClass('d-none');
        });

        // Tag input
        if (document.querySelector('#tags')) {
            let myTagInput = new TagsInputs({
                selector: '#tags',
                duplicate: false,
                max: 100,
            });
            myTagInput.addData(['tags']);
        }

        // Attachment name display
        // $(document).on('change', '#attachment', function(){
        //     let uploadImage = document.querySelector(".uploadImage");
        //     let file = document.querySelector(".inputTag").files[0];
        //     if (uploadImage && file) {
        //         uploadImage.innerText = file.name;
        //     }
        // });

        

        // Hourly/fixed toggle
        $(document).on('change', '#type', function(){
            let type = $(this).val();
            $('.manage-hourly-jobs').toggleClass('d-none', type !== 'hourly');
            $('.manage-fixed-jobs').toggleClass('d-none', type === 'hourly');
        });

        // Confirm create job button
        $(document).on('click','#confirm_create_job',function(){
            let type = $('#type').val();
            let budget = $('#budget').val();
            let skills = $('#skill').val();
            if(!type || !budget || !skills){
                toastr_warning_js(@json(__('Except attachment all fields required !')));
                return false;
            } else {
                $('#job_create_load_spinner').html('<i class="fas fa-spinner fa-pulse"></i>');
            }
        });

        // Share job logic
        $('.share-job-btn').on('click', function () {
            let jobId = $(this).data('job-id');
            let jobLink = `{{ url('/job/details') }}/${jobId}`;

            $('#shareJobLink').val(jobLink);
            $('#shareFacebook').attr('href', `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(jobLink)}`);
            $('#shareTwitter').attr('href', `https://twitter.com/intent/tweet?url=${encodeURIComponent(jobLink)}`);
            $('#shareLinkedIn').attr('href', `https://www.linkedin.com/shareArticle?mini=true&url=${encodeURIComponent(jobLink)}`);

            $('#shareJobModal').modal('show');
        });

    }); // End document.ready
})(jQuery);

// Multi-step form logic
function pre_next() {
    let Listings = document.querySelectorAll(".single-setup-request-list li");
    let sections = document.querySelectorAll(".setup-wrapper-contents");
    let current = 0;

    function toggleListings() {
        Listings.forEach((e) => e.classList.remove('running'));
        Listings[current].classList.add("running");
        Listings[current].classList.remove("completed");
        if (current !== 0) {
            Listings[current - 1].classList.add("completed");
        }
    }

    function toggleSections() {
        sections.forEach((section) => section.classList.remove('active'));
        sections[current].classList.add("active");
    }

    $(document).on("click", "#next", function (e){
        e.preventDefault();

        if (current === 0) {
            let project_name = $('#project_name').val();
            let project_description = $('#project_description').val();
            if (!project_name || !project_description || project_name.length < 5 || project_description.length < 10) {
                toastr_warning_js(@json(__('Please fill all fields and ensure minimum lengths.')));
                return;
            }
        }

        if (current === 2) {
            let category = $('#category').val();
            let subcategory = $('#subcategory').val();
            let title = $('#title').val();
            let description = $('#description').val();
            let level = $('#level').val();
            let duration = $('#duration').val();

            if (!category || !subcategory || !title || !description || !level || !duration ||
                title.length < 5 || description.length < 10) {
                toastr_warning_js(@json(__('Please fill all fields and ensure valid lengths.')));
                return;
            }

            $('.setup-footer-right').html('<button type="submit" class="btn-profile btn-bg-1" id="confirm_create_job">{{ __("Create Job") }}<span id="job_create_load_spinner"></span></button>');
        }

        current++;
        toggleListings();
        toggleSections();
    });

    $(document).on("click", "#previous", function (){
        if (current > 0) {
            current--;
            if(current === 2){
                $('.setup-footer-right').html('<input type="submit" class="btn-profile btn-bg-1" value="{{ __("Create Job") }}">');
            } else {
                $('.setup-footer-right').html('<a href="javascript:void(0)" class="setup-footer-next next" id="next"><i class="fas fa-arrow-right"></i></a>');
            }
            toggleListings();
            toggleSections();
        }
    });
}
</script>
