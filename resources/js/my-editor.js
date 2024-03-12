// import EditorJS from "@editorjs/editorjs";
// import ImageTool from "@editorjs/image";
//
// const saveBtn = document.getElementById("save-data");
// const imageUploadUrl = saveBtn.dataset.imageUpload;
// const meta = document.head.querySelector('meta[name="csrf-token"]');
//
// const editor = new EditorJS({
//     holder: "editorjs",
//     styles: {
//         width: "100vw",
//     },
//     placeholder: "Напишите что-нибудь...",
//     tools: {
//         image: {
//             class: ImageTool,
//             config: {
//                 endpoints: {
//                     byFile: `${imageUploadUrl}`,
//                 },
//                 additionalRequestData: {
//                     upload_preset: "cqxjdiz4",
//                 },
//                 captionPlaceholder: "none",
//                 buttonContent: "Загрузить превью",
//                 additionalRequestHeaders: {
//                     "X-CSRF-TOKEN": meta.content,
//                 },
//                 uploader: {
//                     // async uploadByFile(file) {
//                     //     const formData = new FormData();
//                     //
//                     //     formData.append("file", file);
//                     //     formData.append("upload_preset", "cqxjdiz4");
//                     //
//                     //     const result = await fetch("/image-upload", {
//                     //         method: "POST",
//                     //         body: formData,
//                     //     });
//                     //     const data = await result.json();
//                     //
//                     //     return {
//                     //         success: 1,
//                     //         image: {
//                     //             url: data.secure_url,
//                     //         },
//                     //     };
//                     // },
//                     // async uploadByFile(file) {
//                     //     const formData = new FormData();
//                     //     formData.append("image", file);
//                     //     formData.append("upload_preset", "cqxjdiz4");
//                     //
//                     //     return await fetch("/image-upload", {
//                     //         method: "POST",
//                     //         headers: {
//                     //             "X-CSRF-TOKEN": meta.content,
//                     //         },
//                     //         body: formData,
//                     //     })
//                     //         .then((response) => response.json())
//                     //         .then((result) => {
//                     //             return {
//                     //                 success: 1,
//                     //                 file: {
//                     //                     url: result.url,
//                     //                 },
//                     //             };
//                     //         })
//                     //         .catch((error) => {
//                     //             console.error("Upload failed:", error);
//                     //             return {
//                     //                 success: 0,
//                     //             };
//                     //         });
//                     // },
//                 },
//             },
//         },
//     },
// });
//
// if (saveBtn) {
//     saveBtn.addEventListener("click", (e) => {
//         e.preventDefault();
//
//         const aTag = e.target;
//
//         const url = aTag.getAttribute("href");
//
//         editor
//             .save()
//             .then((outputData) => {
//                 axios({
//                     method: "post",
//                     url: url,
//                     data: {
//                         content_data: outputData,
//                         likes_count: 0,
//                         views_count: 0,
//                     },
//                 });
//             })
//             .catch((error) => {
//                 console.warn("Saving failed: ", error);
//             });
//     });
// }
