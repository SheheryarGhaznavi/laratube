Vue.component('upload-video',{
    props: {
        channel: {
            type: Object,
            required: true,
            default: () => ({})
        }
    },
    data: () => ({
        selected: false,
        videos: []
    }),

    methods: {
        upload() {
            this.selected = true;
            this.videos = Array.from(this.$refs.video.files);

            const uploaders = this.videos.map(video => {
                const form = new FormData()
                form.append('title',video.name)
                form.append('video',video)

                return axios.post('',form)
            })
            console.log(uploaders);
        }
    },
});