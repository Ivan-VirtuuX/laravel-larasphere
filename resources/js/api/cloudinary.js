export const Cloudinary = (instance) => ({
    async changeImage(imageFormData) {
        const data = await instance.post("/upload", imageFormData);

        return data;
    },
});
