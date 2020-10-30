$('input[type="file"]').change(function(e) {
    let file = e.target.files[0];
    
   

   let options = {
       url: `${mainUrl}/panel/movie/add`,
     
   };

 
            let upload = new tus.Upload(file, {
                id: "Tus",
                resume: true,
                chunkSize: 1048576, // 1MB
                endpoint: options.url,
                retryDelays: [0, 500, 1000, 1500, 2000, 2500],
               
                metadata: {
                    filename: file.name,
                    filetype: file.type
                },
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
                   
                   
                }
            });
            upload.start();
});
