# OffObjDetect
Run YOLO (Object Detection,[link](https://pjreddie.com/darknet/yolo/)) locally on the phone or offload to the server
# How to use
## Configure Tensorflow Android (Client)
* Install android tensorflow according to [this link](https://github.com/tensorflow/tensorflow/tree/master/tensorflow/examples/android)
* Change all of the .java file I provide, and the xml file. Note AppendLog.java file should be in src/org/tensorflow/demo/ folder.
* Download [link](https://drive.google.com/file/d/0B_1rCOO36m5ER09seXlDOTl2S0U/view?usp=sharing), and put it in android/assest.
* Run ```bazel build -c opt //tensorflow/examples/android:tensorflow_demo``` (should follow the instruction of [this link](https://github.com/tensorflow/tensorflow/tree/master/tensorflow/examples/android).
* the .apk file will be in /tensorflow/bazel-bin/tensorflow/examples/android/tensorflow_demo.apk

## To be continued