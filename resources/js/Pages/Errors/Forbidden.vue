<template>
    <div class="relative bg-black h-screen w-full flex flex-col justify-center items-center text-white">
        <div
            class="relative w-[800px] h-[600px] transform scale-[0.8] grid bg-no-repeat bg-center bg-[url('https://aimieclouse.com/Media/Portfolio/Error403Forbidden/HauntedHouseBackground.png')] bg-cover">
            <div v-for="(bat, index) in bats" :key="index" :class="`absolute z-10 opacity-0 animate-flyBat${index + 1}`"
                :style="bat.style">
                <img class="absolute w-[150px] origin-right leftwing animate-flapLeft"
                    src="https://aimieclouse.com/Media/Portfolio/Error403Forbidden/bat-wing.png" />
                <img class="absolute w-[50px] top-3 body"
                    src="https://aimieclouse.com/Media/Portfolio/Error403Forbidden/bat-body.png" alt="bat" />
                <img class="absolute w-[150px] origin-right transform scale-x-[-1] rightwing animate-flapRight"
                    src="https://aimieclouse.com/Media/Portfolio/Error403Forbidden/bat-wing.png" />
            </div>
            <img class="absolute top-[-230px] z-20 w-full"
                src="https://aimieclouse.com/Media/Portfolio/Error403Forbidden/HauntedHouseForeground.png"
                alt="haunted house" />
        </div>
        <h1 class="text-6xl font-creepster text-white mt-[-200px] tracking-wider">ERROR 403</h1>
        <div class="text-xl text-yellow-500 uppercase mt-[-60px]">This area is forbidden. Turn back now!</div>
    </div>
</template>


<script>
import { defineComponent, reactive } from "vue";

export default defineComponent({
    name: "ForbiddenView",
    setup() {
        const bats = reactive([
            { style: "top: 380px; left: 120px; transform: scale(0.5);" },
            { style: "top: 280px; left: 80px; transform: scale(0.3);" },
            { style: "top: 200px; left: 150px; transform: scale(0.4);" },
        ]);

        return { bats };
    },
});
</script>


<style scoped>
@keyframes flapLeft {
    0% {
        transform: rotateZ(0);
    }

    50% {
        transform: rotateZ(10deg) rotateY(40deg);
    }

    100% {
        transform: rotateZ(0);
    }
}

@keyframes flapRight {
    0% {
        transform: scaleX(-1) rotateZ(0);
    }

    50% {
        transform: scaleX(-1) rotateZ(10deg) rotateY(40deg);
    }

    100% {
        transform: scaleX(-1) rotateZ(0);
    }
}

@keyframes flyBat1 {
    0% {
        opacity: 1;
        transform: scale(0.5) translate(0, 0);
    }

    25% {
        opacity: 1;
        transform: scale(0.5) translate(-400px, -330px);
    }

    50% {
        opacity: 1;
        transform: scale(0.5) translate(400px, -800px);
    }

    75% {
        opacity: 1;
        transform: scale(0.5) translate(600px, 100px);
    }

    100% {
        opacity: 1;
        transform: scale(0.5) translate(100px, 300px);
    }
}

@keyframes flyBat2 {
    0% {
        opacity: 1;
        transform: scale(0.3) translate(0, 0);
    }

    25% {
        opacity: 1;
        transform: scale(0.3) translate(200px, -330px);
    }

    50% {
        opacity: 1;
        transform: scale(0.3) translate(-300px, -800px);
    }

    75% {
        opacity: 1;
        transform: scale(0.3) translate(-400px, 100px);
    }

    100% {
        opacity: 1;
        transform: scale(0.3) translate(100px, 300px);
    }
}

@keyframes flyBat3 {
    0% {
        opacity: 1;
        transform: scale(0.4) translate(0, 0);
    }

    25% {
        opacity: 1;
        transform: scale(0.4) translate(-350px, -330px);
    }

    50% {
        opacity: 1;
        transform: scale(0.4) translate(400px, -800px);
    }

    75% {
        opacity: 1;
        transform: scale(0.4) translate(-600px, 100px);
    }

    100% {
        opacity: 1;
        transform: scale(0.4) translate(100px, 300px);
    }
}

.animate-flyBat1 {
    animation: flyBat1 10s infinite;
}

.animate-flyBat2 {
    animation: flyBat2 10s infinite;
}

.animate-flyBat3 {
    animation: flyBat3 10s infinite;
}
</style>
