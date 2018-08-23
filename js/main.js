var mediaConstraints = {
    audio: true,
    video: true
};

navigator.getUserMedia(mediaConstraints, onMediaSuccess, onMediaError);

function onMediaSuccess(stream) {
    var mediaRecorder = new MediaStreamRecorder(stream);
    mediaRecorder.mimeType = 'video/webm';
    mediaRecorder.ondataavailable = function(blob) {
        // upload each blob to PHP server
        uploadToPHPServer(blob);
    };
    mediaRecorder.start(3000);
}

function onMediaError(e) {
    console.error('media error', e);
}

function uploadToPHPServer(blob) {
    var file = new File([blob], 'msr-' + (new Date).toISOString().replace(/:|\./g, '-') + '.webm', {
        type: 'video/webm'
    });

    // create FormData
    var myForm = document.getElementById('submitForm');
    var formData = new FormData(myForm);
    formData.append('video-filename', file.name);
    formData.append('video-blob', file);

    makeXMLHttpRequest('recorder/submit-exam.php', formData, function() {
        var downloadURL = 'recorder/exam-videos' + file.name;
        console.log('File uploaded to this path:', downloadURL);
    });
}

function makeXMLHttpRequest(url, data, callback) {
    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            callback();
        }
    };
    request.open('POST', url);
    request.send(data);
}
