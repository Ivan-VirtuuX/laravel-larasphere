import { Cloudinary } from "./cloudinary";
import axios from "axios";

export const CloudinaryApi = () => {
    const instance = axios.create({
        baseURL: "https://api.cloudinary.com/v1_1/virtuux/image",
    });

    const apis = {
        cloudinary: Cloudinary,
    };

    return Object.entries(apis).reduce((prev, [key, f]) => {
        return {
            ...prev,
            [key]: f(instance),
        };
    }, {});
};
