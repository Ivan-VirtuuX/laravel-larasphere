<script setup>
import { onUnmounted, ref, watch } from "vue";
import { useIntersectionObserver } from "@vueuse/core";
import EyeIcon from "@/components/ui/EyeIcon.vue";
import LikeBtn from "@/components/LikeBtn.vue";
import CrossIcon from "@/components/ui/CrossIcon.vue";
import MeatBallMenu from "@/components/ui/MeatBallMenu.vue";

const {
    isAuth,
    authUserId,
    userId,
    userName,
    likesCount,
    postViewsCount,
    isLiked,
    isViewed,
    id,
    avatarUrl,
    createdAt,
} = defineProps([
    "isAuth",
    "authUserId",
    "userId",
    "userName",
    "likesCount",
    "postViewsCount",
    "isLiked",
    "isViewed",
    "id",
    "avatarUrl",
    "createdAt",
]);

const viewsCount = ref(postViewsCount);

const target = ref(null);
const targetIsVisible = ref(false);
const isPostViewed = ref(isViewed);

const { stop } = useIntersectionObserver(
    target,
    ([{ isIntersecting }], observerElement) => {
        targetIsVisible.value = isIntersecting;
    }
);

const addView = async () => {
    try {
        viewsCount.value++;
        isPostViewed.value = true;

        const meta = document.head.querySelector('meta[name="csrf-token"]');

        await axios.post(
            "/posts/add-view",
            {
                post_id: id,
            },
            {
                headers: {
                    "X-CSRF-TOKEN": meta.content,
                },
            }
        );
    } catch (err) {
        console.warn(err);
    }
};

const onDeletePost = async () => {
    try {
        await axios.delete(`/posts/${id}`);

        window.location.href = "/";
    } catch (err) {
        console.warn(err);
    }
};

watch(targetIsVisible, () => {
    if (!isPostViewed.value && isAuth) addView();
});

onUnmounted(() => stop());
</script>

<template>
    <div class="post mt-4" ref="target">
        <div
            class="post-head d-flex justify-content-between align-items-center"
        >
            <a :href="`/users/${userId}`" class="text-decoration-none">
                <div class="d-flex align-items-center column-gap-3">
                    <img
                        class="post-user-avatar rounded-5 object-fit-cover"
                        :src="avatarUrl"
                        alt="avatar"
                    />
                    <div class="d-flex flex-column">
                        <span class="text-primary fw-bold fs-5">{{
                            userName
                        }}</span>
                        <span class="post-date">{{
                            new Date(createdAt).toLocaleDateString("ru-RU", {
                                day: "numeric",
                                month: "short",
                                year: "numeric",
                            })
                        }}</span>
                    </div>
                </div>
            </a>
            <div>
                <div class="dropdown">
                    <button
                        v-if="isAuth && userId === Number(authUserId)"
                        class="dropdown-toggle post-dropdown-button p-0"
                        type="button"
                        id="dropdownMenu2"
                        data-bs-toggle="dropdown"
                        aria-expanded="false"
                    >
                        <meat-ball-menu />
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                        <li>
                            <button
                                class="dropdown-item d-flex align-items-center column-gap-2"
                                type="button"
                                @click="onDeletePost"
                            >
                                <cross-icon />
                                <span>Удалить</span>
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <slot />
        <div
            class="post-bottom d-flex align-items-center justify-content-between"
        >
            <like-btn
                :style="{ pointerEvents: isAuth ? 'auto' : 'none' }"
                :likes-count="likesCount"
                :is-post-liked="isLiked"
                :post-id="id"
            ></like-btn>
            <div
                class="d-flex align-items-center column-gap-2 user-select-none"
            >
                <eye-icon />
                <span class="viewsCount fw-bold">{{ viewsCount }}</span>
            </div>
        </div>
    </div>
</template>

<style scoped lang="scss">
@import "/resources/sass/variables";

.viewsCount {
    color: $primary;
    margin-top: 1px;
    font-size: 13px;
}

.post-dropdown-button {
    background: none;
    border: none;

    &:after {
        display: none;
    }
}

.post-date {
    font-size: 13px;
    color: #858585;
}
</style>
