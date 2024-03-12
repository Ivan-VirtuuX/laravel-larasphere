<script setup>
const { currentAvatarUrl, isUploading } = defineProps([
    "currentAvatarUrl",
    "isUploading",
]);

const emits = defineEmits(["onCloseModal", "onSubmitAttachedImage"]);
</script>

<template>
    <div
        class="modal fade show d-block"
        id="exampleModal"
        role="dialog"
        tabindex="-1"
        aria-modal="true"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true"
    >
        <div class="modal-dialog">
            <div class="modal-content p-4">
                <div class="d-flex align-items-center justify-content-between">
                    <h5
                        class="m-0 text-center flex-grow-1 fw-bold text-primary fs-3"
                        id="exampleModalLabel"
                    >
                        Редактирование аватара
                    </h5>
                    <button
                        ref="closeModalRef"
                        @click="emits('onCloseModal')"
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                    ></button>
                </div>
                <div class="modal-body mb-3">
                    <div class="d-flex justify-content-center">
                        <img
                            class="change-avatar-image"
                            :src="currentAvatarUrl"
                            alt="avatar"
                        />
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    <button
                        :disabled="isUploading"
                        @click="emits('onSubmitAttachedImage')"
                        type="button"
                        class="btn btn-primary w-75 upload-button"
                    >
                        Сохранить
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-backdrop fade show"></div>
</template>

<style scoped lang="scss">
.modal-dialog {
    width: 400px;
}

.change-avatar-image {
    width: 200px;
    height: 200px;
    object-fit: cover;
    border-radius: 50%;
}

.upload-button {
    transition: all 0.3s ease-in-out;
}
</style>
