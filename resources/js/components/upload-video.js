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
        videos: [],
        progress: {},
        uploads: [],
        intervals: {}
    }),

    methods: {
        upload() {
            this.selected = true;
            this.videos = Array.from(this.$refs.video.files);

            const uploaders = this.videos.map(video => {

                this.progress[video.name] = 0;

                const form = new FormData()
                form.append('title',video.name)
                form.append('video',video)

                return axios.post('',form,{
                    onUploadProgress : (event) => {
                        this.progress[video.name] = Math.ceil(( event.loaded * 100 ) / event.total)
                        this.$forceUpdate()
                    }
                }).then(({data}) => {
                    this.uploads = [
                        ...this.uploads,
                        data
                    ]
                })
            })

            axios.all(uploaders)
            .then(() => {
                this.videos = this.uploads;

                this.videos.forEach(video => {
                    this.intervals[video.id] = setInterval(() => {
                        axios.get(`/video/${video.id}`).then(({data}) => {

                            console.log(data)
                            if (data.percentage == 100) {
                                clearInterval(this.intervals[video.id])
                            }

                            this.videos = this.videos.map(v => {
                                if (v.id == data.id) {
                                    return data;
                                }

                                return v
                            })
                        })
                    }, 3000)
                });
            })
        }
    },
});