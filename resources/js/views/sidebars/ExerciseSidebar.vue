<template>
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="fa fa-keyboard"></i>
            <p>
                Exercise
                <i class="fas fa-angle-left right"> </i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <fizz-buzz-sidebar></fizz-buzz-sidebar>
            <palindrome-sidebar></palindrome-sidebar>
            <odd-even-sidebar></odd-even-sidebar>
            <linear-search-sidebar></linear-search-sidebar>
            <find-max-sidebar></find-max-sidebar>
            <bubble-sort-sidebar></bubble-sort-sidebar>
        </ul>
    </li>
</template>
<script>
import FizzbuzzSidebar from "./FizzbuzzSidebar.vue";
import PalindromeSidebar from "./PalindromeSidebar.vue";
import FindmaxSidebar from "./FindmaxSidebar.vue";
import BubblesortSidebar from "./BubblesortSidebar.vue";
import LinearsearchSidebar from "./LinearsearchSidebar.vue";
import OddEvenSidebar from "./OddEvenSidebar.vue"
export default {
    name: "ExerciseSidebar",
    components: {
        "fizz-buzz-sidebar": FizzbuzzSidebar,
        "palindrome-sidebar": PalindromeSidebar,
        "linear-search-sidebar": LinearsearchSidebar,
        "bubble-sort-sidebar": BubblesortSidebar,
        "find-max-sidebar": FindmaxSidebar,
        "odd-even-sidebar" : OddEvenSidebar
    },
};
</script>
