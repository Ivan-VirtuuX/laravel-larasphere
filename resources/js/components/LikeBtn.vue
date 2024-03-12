<script setup>
import HeartIcon from "@/components/ui/HeartIcon.vue";
import { ref } from "vue";
import VoidHeartIcon from "@/components/ui/VoidHeartIcon.vue";

const { likesCount, isPostLiked, postId } = defineProps([
    "likesCount",
    "isPostLiked",
    "postId",
]);

const likes = ref(likesCount);
const isLiked = ref(isPostLiked);

const toggleLike = async () => {
    try {
        isLiked.value = !isLiked.value;

        if (isLiked.value) likes.value++;
        else likes.value--;

        await axios.post("/posts/toggle-like", {
            post_id: postId,
        });
    } catch (err) {
        console.warn(err);
    }
};
</script>

<template>
    <div
        class="like-btn d-flex column-gap-2 fw-bold user-select-none"
        @click="toggleLike"
    >
        <a v-if="isLiked">
            <heart-icon />
        </a>
        <a v-else>
            <void-heart-icon />
        </a>
        <span :class="isLiked ? 'textRed' : 'textPrimary'">{{ likes }}</span>
    </div>
</template>

<style scoped lang="scss">
@import "/resources/sass/variables";

.like-btn {
    font-size: 13px;
    cursor: pointer;
}

.textRed {
    color: $red;
    margin-top: 1px;
}

.textPrimary {
    color: $primary;
    margin-top: 1px;
}
</style>
