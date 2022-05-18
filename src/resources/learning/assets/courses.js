const values = {
    title: "Shorten any link",
    description: "Build and protect your brand by using powerful and recognizable short links.",
    metaDescription: "It's free forever.",
    buttonText: "Shorten",
    inputPlaceholder: "Type or paste your link",
    modalLinkButtonText: "Copy",
    modalPromptText: "Share link in social platforms:"
}


const videos = {
    items: [
        {
            id: 1,
            name: "getting started",
            count: 5,
            duration: 27,
            videos: [
                {
                    title: "introduction",
                    duration: 3,
                    url: "https://goo.gl/jklkl"
                },
                {
                    title: "introduction",
                    duration: 3,
                    url: "https://goo.gl/jklkl"
                },
                {
                    title: "introduction",
                    duration: 3,
                    url: "https://goo.gl/jklkl"
                },
            ]
        },
        {
            id: 2,
            name: "getting started",
            count: 3,
            duration: 27,
            videos: [
                {
                    title: "introduction",
                    duration: 3,
                    url: "https://goo.gl/jklkl"
                },
                {
                    title: "introduction",
                    duration: 3,
                    url: "https://goo.gl/jklkl"
                },
                {
                    title: "introduction",
                    duration: 3,
                    url: "https://goo.gl/jklkl"
                },
            ]
        },
        {
            id: 1,
            name: "getting started",
            count: 5,
            duration: 27,
            videos: [
                {
                    title: "introduction",
                    duration: 3,
                    url: "https://goo.gl/jklkl"
                },
                {
                    title: "introduction",
                    duration: 3,
                    url: "https://goo.gl/jklkl"
                },
                {
                    title: "introduction",
                    duration: 3,
                    url: "https://goo.gl/jklkl"
                },
            ]
        },
        {
            id: 1,
            name: "getting started",
            count: 5,
            duration: 27,
            videos: [
                {
                    title: "introduction",
                    duration: 3,
                    url: "https://goo.gl/jklkl"
                },
                {
                    title: "introduction",
                    duration: 3,
                    url: "https://goo.gl/jklkl"
                },
                {
                    title: "introduction",
                    duration: 3,
                    url: "https://goo.gl/jklkl"
                },
            ]
        },
        {
            id: 1,
            name: "getting started",
            count: 5,
            duration: 27,
            videos: [
                {
                    title: "introduction",
                    duration: 3,
                    url: "https://goo.gl/jklkl"
                },
                {
                    title: "introduction",
                    duration: 3,
                    url: "https://goo.gl/jklkl"
                },
                {
                    title: "introduction",
                    duration: 3,
                    url: "https://goo.gl/jklkl"
                },
            ]
        },
        {
            id: 1,
            name: "getting started",
            count: 5,
            duration: 27,
            videos: [
                {
                    title: "introduction",
                    duration: 3,
                    url: "https://goo.gl/jklkl"
                },
                {
                    title: "introduction",
                    duration: 3,
                    url: "https://goo.gl/jklkl"
                },
                {
                    title: "introduction",
                    duration: 3,
                    url: "https://goo.gl/jklkl"
                },
            ]
        },
    ]
}
// Next / Previous
let count = 0;
const pagination = videos.items.map((module) => {
    return module.videos.map((video) => {
        video.index = count++;
        return video;
    })
}).flat();

console.log(pagination)