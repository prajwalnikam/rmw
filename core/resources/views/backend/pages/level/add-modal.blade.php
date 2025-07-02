<!-- Country Edit Modal -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">{{ __('Add New Experience Level') }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('admin.experience.level.all')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <x-form.text :title="__('Experience Level')" :type="__('text')" :name="'level'" :id="'level'" :value="old('level', '')" :placeholder="__('Enter level')"/>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary mt-4" data-bs-dismiss="modal">{{ __('Close') }}</button>
                    <x-btn.submit :title="__('Save')" :class="'btn btn-primary mt-4 pr-4 pl-4 add_level'" />
                </div>
            </form>
        </div>
    </div>
</div>
