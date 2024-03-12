<script setup>
import CameraIcon from "@/components/ui/CameraIcon.vue";
import { ref, watch } from "vue";
import { CloudinaryApi } from "@/api/CloudinaryApi.js";
import ChangeAvatarModal from "@/components/ChangeAvatarModal.vue";

const { avatarUrl } = defineProps(["avatarUrl"]);

const currentAvatarUrl = ref(avatarUrl);

const attachedImageFormData = ref([]);

const isUploading = ref(false);
const isOpened = ref(false);

const attachedImageRef = ref(null);

const handleChangeImage = async (files) => {
    try {
        const formData = new FormData();

        formData.append("file", files[0]);
        formData.append("upload_preset", "cqxjdiz4");

        attachedImageFormData.value = formData;

        const file = files[0];

        currentAvatarUrl.value = URL.createObjectURL(file);
    } catch (err) {
        console.warn(err);
    }
};

const onSubmitAttachedImage = async () => {
    try {
        isUploading.value = true;

        const { data } = await CloudinaryApi().cloudinary.changeImage(
            attachedImageFormData.value
        );

        await axios.patch("/profile/update-avatar", {
            avatar_url: data.secure_url,
        });

        currentAvatarUrl.value = data.secure_url;

        return data;
    } catch (err) {
        console.warn(err);
    } finally {
        isUploading.value = false;

        document.location.href = "/profile";

        attachedImageFormData.value = [];
    }
};

const onChangedAttachedImage = (e) => handleChangeImage(e.target.files);

const onCloseModal = () => {
    attachedImageRef.value.files = null;
    attachedImageFormData.value = null;

    isOpened.value = false;
};

watch([attachedImageRef, currentAvatarUrl], () => {
    if (attachedImageRef.value.files.length !== 0) isOpened.value = true;
    else onCloseModal();
});
</script>

<template>
    <div class="avatar-block d-flex flex-column align-items-center">
        <button
            @click="() => $refs.attachedImageRef.click()"
            class="change-avatar-button shadow-sm"
            type="button"
            data-bs-toggle="modal"
            data-bs-target="#exampleModal"
        >
            <input
                accept="image/*"
                ref="attachedImageRef"
                type="file"
                @change="onChangedAttachedImage"
                hidden
            />
            <camera-icon />
        </button>
        <slot />
    </div>
    <change-avatar-modal
        v-if="isOpened"
        @onCloseModal="onCloseModal"
        @onSubmitAttachedImage="onSubmitAttachedImage"
        :current-avatar-url="currentAvatarUrl"
        :is-uploading="isUploading"
    />
</template>

<style scoped lang="scss">
.avatar-block {
    position: relative;
}

.change-avatar-button {
    position: absolute;
    border-radius: 50%;
    width: 35px;
    height: 35px;
    border: none;
    bottom: -17px;
    display: flex;
    justify-content: center;
    align-items: center;
    background: #fff;
}
</style>
