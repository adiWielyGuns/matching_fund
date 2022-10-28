<div class="card">
    <div class="card-header bg-primary d-flex justify-content-between">
        <h4 class="header-title text-light">{{ convertSlug($data->name) }}</h4>
    </div>
    <form class="card-body" id="form-data" onkeydown="return event.key != 'Enter';">
        <div class="row">
            @if ($data->example)
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="">Example</label><br>
                        <img style="max-width: 100%" src="{{ $data->example }}" alt="">
                    </div>
                </div>
            @endif
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="">Type</label><br>
                    <input type="text" class="form-control" readonly id="type" name="type"
                        value="{{ $data->type }}">
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="">Value</label><br>
                    @if ($data->type == 'IMAGE')
                        <input class="form-control dropify" type="file" id="value"
                            data-allowed-file-extensions="jpg jpeg png">
                    @elseif($data->type == 'URL')
                        <div class="input-group">
                            <div class="input-group-prepend bg-custom b-0">
                                <span class="input-group-text">https://</span>
                            </div>
                            <input type="text" class="form-control required" name="value"
                                placeholder="Masukan value" id="value">
                        </div>
                    @elseif ($data->type == 'INPUT')
                        <input class="form-control" type="text" name="value" id="value">
                    @else
                        <div id="summernote"></div>
                    @endif
                    <input type="hidden" id="id" name="id" value="{{ $data->id }}">
                </div>
            </div>
            <div class="col-sm-12 text-right">
                <button type="button" class="btn btn-primary" onclick="store()">
                    <i class="fas fa-save mr-2"> </i>Save
                </button>
            </div>
        </div>

    </form>
</div>
<script>
    $(document).ready(function() {
        $('#summernote').summernote({
            height: 300, // set editor height
            minHeight: null, // set minimum height of editor
            maxHeight: null, // set maximum height of editor
            focus: true // set focus to editable area after initializing summernote
        });

        $('.dropify').dropify({
            messages: {
                'default': 'Drag and drop a file here or click',
                'replace': 'Drag and drop or click to replace',
                'remove': 'Remove',
                'error': 'Ooops, something wrong happended.'
            }
        });
    });
</script>
