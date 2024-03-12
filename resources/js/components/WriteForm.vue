<script setup>
import UploadPostBtn from "@/components/UploadPostBtn.vue";
import { ref } from "vue";
import Editor from "@/components/Editor.vue";

const { btnHref, btnDataImageUpload } = defineProps([
    "btnHref",
    "btnDataImageUpload",
]);

const blocks = ref([]);
const isUploading = ref(false);

const onChangeBlocks = (newBlocks) => (blocks.value = newBlocks);

const onImageUploading = (value) => (isUploading.value = value);
</script>

<template>
    <form :action="btnHref" method="POST">
        <div class="d-flex flex-column align-items-center row-gap-2 mb-4">
            <p class="text-center fs-1 fw-bold text-primary m-0">
                Создание поста
            </p>
            <upload-post-btn
                :blocks="blocks"
                :isImageUploading="isUploading"
                :isEmpty="!blocks.length"
                :href="btnHref"
                :dataImageUpload="btnDataImageUpload"
            >
            </upload-post-btn>
        </div>
    </form>
    <editor
        @on-change-blocks="onChangeBlocks"
        @on-image-uploading="onImageUploading"
    />
</template>
