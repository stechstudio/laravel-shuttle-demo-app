@props(['trigger' => false, 'dropTarget' => 'body', 'config' => '{}'])

<div class="drop-target absolute inset-0 z-50 bg-gray-500 bg-opacity-75 items-center justify-center">
    <div class="text-2xl xl:text-4xl text-white font-bold flex flex-col items-center">
        <svg class="w-32 h-32 opacity-50 mb-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M5.5 13a3.5 3.5 0 01-.369-6.98 4 4 0 117.753-1.977A4.5 4.5 0 1113.5 13H11V9.413l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13H5.5z"></path><path d="M9 13h2v5a1 1 0 11-2 0v-5z"></path></svg>

        <div>Drop files to upload</div>
    </div>
</div>

<div
    x-title="shuttle"

    x-data="Shuttle({
        baseUrl: '{{ Shuttle::baseUrl() }}',
        context: @entangle('uploadContext'),
        dropTarget: '{{ $dropTarget }}',
    })"

    x-init="() => {
        window.addEventListener('beforeunload', unload());

        uppy = new Uppy({
            autoProceed: true,
            allowMultipleUploads: true,
            debug: true,
            onBeforeFileAdded: (file) => {
                file.meta = Object.assign(file.meta, config.context);
                file.meta.size = file.data.size;
            }
        }).use(UppyDropTarget, {
            target: document.querySelector(config.dropTarget)
        }).use(AwsS3Multipart, {
            limit: 300,
            companionUrl: config.baseUrl,
        }).on('file-added', (file) => {
            setState('UPLOADING');
            files[file.id] = { id: file.id, name : file.name, size: file.size, progress: 0, status: 'uploading' };
        }).on('upload-progress', (file, progress) => {
            files[file.id].progress = Math.round(progress.bytesUploaded / progress.bytesTotal * 100);
        }).on('progress', (progress) => {
            percent = progress;
        }).on('upload-success', (file, response) => {
            filesUploaded++;
            files[file.id].status = 'complete';

            setTimeout(() => {
                delete files[file.id];
                @this.render();
            }, 500);
        }).on('upload-error', (file, error, response) => {
            files[file.id].status = 'error';
        }).on('file-removed', (file, reason) => {
            delete files[file.id];
        }).on('complete', (result) => {
            if (result.failed.length) {
                setState('COMPLETE_WITH_ERRORS');
            } else {
                complete();
            }
        });
    }"

    x-on:select-files.window="document.querySelector('.uppy-trigger').click(); if ('activeElement' in document) document.activeElement.blur();"
>
    <div class="absolute inset-x-0 bottom-0 z-50" wire:ignore>
        <input x-on:change="loadFiles($event)" type="file" class="hidden uppy-trigger" name="files[]" multiple>

        <div
            x-bind:class="{ 'bg-primary-500': state == 'UPLOADING' , 'bg-green-500': state == 'COMPLETE', 'bg-primary-700': state == 'COMPLETE_WITH_ERRORS' }"
            x-show="state != 'IDLE'"
            class="px-6 py-3 text-white font-semibold flex items-center" style="display: none"
        >
            <div class="mr-4">
                <div x-show="state == 'UPLOADING' && percent == 0">
                    Preparing...
                </div>

                <div x-show="state == 'UPLOADING' && percent > 0">
                    <span x-text="filesRemaining()"></span> remaining
                </div>

                <div x-show="state == 'COMPLETE'">
                    Finished successfully
                </div>

                <div x-show="state == 'COMPLETE_WITH_ERRORS'">
                    Finished with errors
                </div>
            </div>

            <div class="flex-grow">
                <div x-bind:style="'width: ' + percent + '%'" class="h-1 bg-white"></div>
            </div>

            <div class="mx-4 w-12 text-right">
                <span x-text="percent + '%'" x-show="percent > 0"></span>
            </div>

            <div class="text-lg opacity-75 hover:opacity-100 cursor-pointer">
                <i @click="showDetails = ! showDetails" x-show="! showDetails" class="fad fa-chevron-double-up"></i>
                <i @click="showDetails = ! showDetails" x-show="showDetails" class="fad fa-chevron-double-down"></i>
            </div>
        </div>

        <div class="bg-white divide-y divide-gray-200 text-sm xl:text-base text-gray-700 max-h-48 overflow-y-auto">
            <template x-for="[id, file] of Object.entries(files)" :key="id">
                <div class="flex justify-between items-center px-4 py-3" x-show.transition="showDetails || file.status == 'error'">
                    <div class="flex items-center">
                        <!-- @todo: img src -->
                        <img x-show="file.status == 'uploading'" src="/images/spinner-dual-ring.svg" alt="@todo" class="w-6 h-6">

                        <i x-show="file.status == 'complete'" class="far fa-check text-green-500 w-6"></i>

                        <i x-show="file.status == 'error'" class="far fa-exclamation-circle text-red-500 w-6"></i>

                        <div x-text="file.name" class="text-gray-700 ml-2"></div>
                    </div>

                    <div class="flex items-center">
                        <div x-text="file.progress"></div>%

                        <div class="w-8 text-right">
                            <i @click="uppy.removeFile(file.id)" x-show="file.status == 'uploading'" class="far fa-times cursor-pointer hover:text-red-500"></i>
                            <i @click="uppy.retryUpload(file.id)" x-show="file.status == 'error'" class="far fa-redo cursor-pointer hover:text-red-500"></i>
                        </div>
                    </div>
                </div>
            </template>
        </div>
    </div>
</div>
