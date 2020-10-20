$('input[type="file"]').change(function(e) {
    let file = e.target.files[0];
    let channelId = "8043a851-109c-4744-9890-eb835b6fd872";
    let authorization = "Apikey 06d34f0a-870f-454d-91a5-b435cf96e208";

    let options = {
        url: `https://napi.arvancloud.com/vod/2.0/channels/${channelId}/videos`,
        authorization: `${authorization}`,
        acceptLanguage: "en",
        uuid: file.name + file.size + file.lastModified
    };
    
    var upload = new tus.Upload(file, {
        endpoint: options.url,
        retryDelays: [0, 3000, 5000, 10000, 20000],
        headers: {
            Authorization: options.authorization,
            "Accept-Language": options.acceptLanguage
        },
        metadata: {
            filename: file.name,
            filetype: file.type
        },
        data: {
            title: "sdfsdfs",
            description: "string",
            video_url: "string",
            convert_mode: "auto"
        },
        onError: function(error) {
            console.log("Failed because: " + error);
        },
        onProgress: function(bytesUploaded, bytesTotal) {
            var percentage = ((bytesUploaded / bytesTotal) * 100).toFixed(2);
            console.log(bytesUploaded, bytesTotal, percentage + "%");
        },
        onSuccess: function() {
            console.log("Download %s from %s", upload.file.name, upload.url);
        }
    });

    upload.start();
});
