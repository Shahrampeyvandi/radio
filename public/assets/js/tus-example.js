$('input[type="file"]').change(function(e) {
    let file = e.target.files[0];
    
    let channelId = "8043a851-109c-4744-9890-eb835b6fd872";
    let authorization = "Apikey 06d34f0a-870f-454d-91a5-b435cf96e208";

   let options = {
       "url": `https://napi.arvancloud.com/vod/2.0/channels/${channelId}/videos`,
       "authorization": `${authorization}`,
       "acceptLanguage": "en",
       "uuid": file.name + file.size + file.lastModified
   };

 
            let upload = new tus.Upload(file, {
                id: "Tus",
                resume: true,
                chunkSize: 1048576, // 1MB
                endpoint: options.url,
                retryDelays: [0, 500, 1000, 1500, 2000, 2500],
                headers: {
                    Authorization: authorization,
                    "Accept-Language": "en",
                    Accept: "application/json",
                    "Content-Type": "application/json",
                    "tus-resumable": "1.0.0"
                },
                metadata: {
                    filename: file.name,
                    filetype: file.type
                }, data: JSON.stringify({
                            title: file.name,
                            file_id: '12313',
                            convert_mode: "auto"
                        }),
                onError: function(error) {
                    console.log("Failed because: " + error);
                },
                onProgress: function(bytesUploaded, bytesTotal) {
                    var percentage = (
                        (bytesUploaded / bytesTotal) *
                        100
                    ).toFixed(2);
                    console.log(bytesUploaded, bytesTotal, percentage + "%");
                },
                onSuccess: function() {
                    console.log(
                        "Download %s from %s",
                        upload.file.name,
                        upload.url
                    );
                    fileId = String(upload.url).substr(88, 125);
                    var opti = {
                        url:
                            "https://napi.arvancloud.com/vod/2.0/channels/" +
                            channelId +
                            "/videos",
                        method: "POST",
                        timeout: 0,
                        headers: {
                            Authorization: authorization,
                            "Accept-Language": "en",
                            Accept: "application/json",
                            "Content-Type": "application/json"
                        },
                        data: JSON.stringify({
                            title: file.name,
                            file_id: fileId,
                            convert_mode: "auto"
                        })
                    };
                    $.ajax(opti).done(function(response) {
                        console.log(response);
                    });
                }
            });
            upload.start();
});
