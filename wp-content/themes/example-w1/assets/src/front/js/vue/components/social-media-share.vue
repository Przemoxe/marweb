<template>
    <ul class="social-icons">

        <li class="share-icon" v-if="showFacebook">
            <a :href="'https://www.facebook.com/sharer/sharer.php?u=' + permalink" target="_blank" class="icon-facebook">
            <span class="fa fa-facebook-square"></span>
            </a>
        </li>

        <li class="share-icon" v-if="showTwitter">
            <a :href="'https://twitter.com/intent/tweet?url=' + permalink + '&text=' + title" target="_blank"
                class="icon-twitter">
                <span class="fa fa-twitter"></span>
            </a>
        </li>

        <li class="share-icon" v-if="showLinkedin">
            <a :href="'https://www.linkedin.com/shareArticle?mini=true&url=' + permalink + '&title=' + title" target="_blank"
                class="icon-linkedin">
                <span class="fa fa-linkedin"></span>
            </a>
        </li>

    </ul>
</template>

<script>

export default
{
    props: ['showFacebook', 'showTwitter', 'showLinkedin', 'permalink', 'title'],
    mounted()
    {
    },
    data: function ()
    {
        return {
        }
    },
    methods:
    {
    }
}
</script>
