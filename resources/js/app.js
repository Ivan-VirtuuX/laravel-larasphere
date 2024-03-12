import "./bootstrap";
import { createApp } from "vue";
import Header from "@/components/Header.vue";
import Logo from "@/components/ui/Logo.vue";
import FormInput from "@/components/FormInput.vue";
import LikeBtn from "@/components/LikeBtn.vue";
import UploadPostBtn from "@/components/UploadPostBtn.vue";
import WriteForm from "@/components/WriteForm.vue";
import Editor from "@/components/Editor.vue";
import Post from "@/components/Post.vue";
import ChangeAvatarButton from "@/components/ChangeAvatarButton.vue";

const app = createApp({});

app.component("header-component", Header);
app.component("logo", Logo);
app.component("form-input", FormInput);
app.component("like-btn", LikeBtn);
app.component("upload-post-btn", UploadPostBtn);
app.component("write-form", WriteForm);
app.component("editor", Editor);
app.component("post", Post);
app.component("change-avatar-button", ChangeAvatarButton);

app.mount("#app");
