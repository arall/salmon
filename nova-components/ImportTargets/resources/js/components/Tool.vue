<template>
    <div>
        <heading class="mb-6">Import Targets</heading>
        <div class="mb-8">
            <div class="card">
                <div class="flex border-b border-40">
                    <div class="w-1/5 px-8 py-6">
                        <label for="csv" class="inline-block text-80 pt-2 leading-tight">CSV</label>
                    </div>
                    <div class="py-6 px-8 w-4/5">
                        <span class="form-file mr-4">
                            <input accept="text/csv" @change="handleFile" dusk="csv" type="file" id="file-csv" ref="file" name="csv" class="form-file-input select-none">
                            <label for="file-csv" class="form-file-btn btn btn-default btn-primary select-none">
                                <span id="file-csv-text">Choose File</span>
                            </label>
                        </span>
                        <span class="text-90 text-sm select-none">{{ csv ? csv.name : 'no file selected' }}</span>
                    </div>
                    <div class="px-8 py-6">
                        <button @click="upload" class="btn btn-default btn-primary inline-flex items-center relative" dusk="create-button">
                            <span class="">Import</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    mounted() {
        //
    },
    data() {
        return {
            csv: '',
        };
    },
    methods: {
        handleFile: function (event) {
            this.csv = this.$refs.file.files[0];
        },
        upload() {
            let formData = new FormData();
            formData.append('csv', this.csv);
            const self = this;

            Nova.request().post('/nova-vendor/import-targets',
                formData
            ).then(function(response){
                self.$toasted.show(response.data.message, {type: "success"});
            })
            .catch(function(e){
                self.$toasted.show(e.response.data.message, {type: "error"});
            });
        }
    }
}
</script>

<style>
/* Scoped Styles */
</style>
