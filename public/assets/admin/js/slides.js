/** @slides component */

new Vue({
    el: "#slider-slides-1",
    data() {
        return {
            locales: window.locales,
            categories: window.categories,
            slides: []
        }
    },
    mounted() {
        this.slides = window.slides || []
        if (this.slides.length === 0) {
            this.add()
        }
    },
    methods: {
        openMedia(index) {
            console.log(index);
            window.payload = {
                target: '#slides-' + index + '-image-input',
            }
            window.openWindow('/file-manager/fm-button', 'fm');
        },
        remove(index) {
            if (this.slides.length === 1) {
                return toastr.warning('Should be at least one slide')
            }
            this.slides.splice(index, 1)
        },
        add() {
            let slide = {
                image: '',
                model_type: 'Category',
                model_id: this.categories[0].id,
                title: {},
                description: {},
            }
            Object.keys(this.locales).forEach(locale => {
                slide.title[locale] = ""
                slide.description[locale] = ""
            })
            this.slides.push(slide)
        }
    }
})
