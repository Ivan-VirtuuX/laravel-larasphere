<script setup>
import Logo from "@/components/ui/Logo.vue";
import BrushIcon from "@/components/ui/BrushIcon.vue";
import FireIcon from "@/components/ui/FireIcon.vue";
import LoginIcon from "@/components/ui/LoginIcon.vue";

const { avatarUrl, login, logoutRoute, isAuth } = defineProps([
    "avatarUrl",
    "login",
    "logoutRoute",
    "isAuth",
]);
</script>

<template>
    <header class="d-flex align-items-center">
        <div
            class="container d-flex align-items-center justify-content-between"
        >
            <a
                href="/"
                class="d-flex column-gap-1 align-items-center text-decoration-none"
            >
                <logo />
                <span class="logo-text">Larasphere</span>
            </a>
            <ul class="d-flex column-gap-4">
                <li>
                    <a
                        href="/posts/create"
                        class="header-link text-decoration-none d-flex align-items-center column-gap-1"
                    >
                        <brush-icon />
                        <span>Создать</span>
                    </a>
                </li>
                <li>
                    <a
                        href="/posts/popular"
                        class="header-link text-decoration-none d-flex align-items-center column-gap-1"
                    >
                        <fire-icon />
                        <span>Популярные</span>
                    </a>
                </li>
            </ul>

            <div v-if="isAuth" class="dropdown">
                <div>
                    <div
                        id="dropdownMenuButton"
                        data-mdb-toggle="dropdown"
                        aria-expanded="false"
                        class="d-flex align-items-center column-gap-2"
                    >
                        <img :src="avatarUrl" alt="" class="header-avatar" />
                        <a
                            href="/profile"
                            class="header-link text-decoration-none"
                            >{{ login }}
                        </a>
                    </div>
                </div>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <li>
                        <a class="dropdown-item" href="/profile">Профиль</a>
                    </li>
                    <li>
                        <a
                            href="{{logoutRoute}}"
                            class="dropdown-item text-decoration-none"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                        >
                            <span>Выйти</span>
                        </a>
                    </li>
                </ul>
            </div>
            <a
                v-else
                href="/login"
                class="header-link text-decoration-none d-flex align-items-center column-gap-1"
            >
                <login-icon />
                <span>Войти</span>
            </a>
        </div>
    </header>
</template>

<style scoped lang="scss">
@import "/resources/sass/variables";

header {
    height: 50px;
    background: #fff;
    box-shadow: 0 -1px 10px #0000001a;
}

.logo-text {
    font-size: 15px;
    font-weight: 700;
}

.header-link {
    font-size: 15px;
    font-weight: 700;
}

.header-avatar {
    width: 30px;
    height: 30px;
    object-fit: cover;
    border-radius: 50%;
}

.dropdown-menu {
    li {
        &:hover {
            .dropdown-item {
                background: $primary;
                color: #fff;
                transition: all 0.2s ease-in-out;
            }
        }
    }
}
</style>
