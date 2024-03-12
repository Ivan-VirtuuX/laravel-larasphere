<script setup>
import UploadIcon from "@/components/ui/UploadIcon.vue";

const { blocks, href, dataImageUpload, isEmpty, isImageUploading } =
    defineProps([
        "blocks",
        "href",
        "dataImageUpload",
        "isEmpty",
        "isImageUploading",
    ]);

const addPost = async () => {
    try {
        await axios.post(
            "/posts/create",
            {
                content_data: [...blocks.value],
            },
            {
                headers: {
                    "Content-Type": "text/html; charset=UTF-8",
                },
            }
        );
    } catch (err) {
        console.warn(err);
    } finally {
        document.location.href = "/";
    }
};
</script>

<template>
    <button
        @click="addPost"
        :disabled="isEmpty || isImageUploading"
        class="btn btn-primary save-btn d-flex align-items-center column-gap-1"
    >
        <a
            class="text-decoration-none"
            :href="href"
            id="save-data"
            :data-image-upload="dataImageUpload"
        >
            <UploadIcon />
            Опубликовать
        </a>
    </button>
</template>

<style scoped lang="scss">
@import "/resources/sass/variables";

.save-btn {
    padding: 5px 10px;
    border-radius: 10px;

    transition: all 0.3s ease-in-out;
    border: none;

    a {
        color: #fff;
    }

    &:hover {
        background: $secondary !important;
    }
}
</style>
