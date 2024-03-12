<script setup>
import { onMounted } from "vue";
import EditorJS from "@editorjs/editorjs";
import ImageTool from "@editorjs/image";
import { CloudinaryApi } from "@/api/CloudinaryApi.js";

const emit = defineEmits(["onChangeBlocks", "onImageUploading"]);

onMounted(() => {
    const saveBtn = document.getElementById("save-data");
    const meta = document.head.querySelector('meta[name="csrf-token"]');

    const editor = new EditorJS({
        holder: "editorjs",
        data: {
            blocks: [],
        },
        async onChange() {
            const { blocks } = await editor.save();

            emit("onChangeBlocks", blocks);

            blocks.value = blocks;
        },
        styles: {
            width: "100vw",
        },
        placeholder: "Напишите что-нибудь...",
        tools: {
            image: {
                class: ImageTool,
                config: {
                    endpoints: {
                        byFile: "https://api.cloudinary.com/v1_1/virtuux/image/upload",
                    },
                    field: "file",
                    additionalRequestData: {
                        upload_preset: "cqxjdiz4",
                    },
                    captionPlaceholder: "none",
                    buttonContent: "Загрузить превью",
                    additionalRequestHeaders: {
                        "X-CSRF-TOKEN": meta.content,
                    },
                    uploader: {
                        /**
                         * @param {File}
                         * @return {Promise.<{success, file: {url}}>}
                         */
                        async uploadByFile(file) {
                            try {
                                emit("onImageUploading", true);

                                const formData = new FormData();

                                formData.append("file", file);
                                formData.append("upload_preset", "cqxjdiz4");

                                const response =
                                    await CloudinaryApi().cloudinary.changeImage(
                                        formData
                                    );

                                emit("onImageUploading", false);

                                return {
                                    success: 1,
                                    file: {
                                        url: response.data.secure_url,
                                    },
                                };
                            } catch (err) {
                                console.warn(err);
                            } finally {
                                emit("onImageUploading", false);
                            }
                        },
                    },
                },
            },
        },
    });

    if (saveBtn) {
        saveBtn.addEventListener("click", (e) => {
            e.preventDefault();

            const aTag = e.target;

            const url = aTag.getAttribute("href");

            editor
                .save()
                .then((outputData) => {
                    axios({
                        method: "post",
                        url: url,
                        data: {
                            content_data: outputData,
                            likes_count: 0,
                            views_count: 0,
                        },
                    });
                })
                .catch((error) => {
                    console.warn("Saving failed: ", error);
                });
        });
    }
});
</script>

<template>
    <div id="editorjs"></div>
</template>
