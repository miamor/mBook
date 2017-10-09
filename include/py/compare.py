# USAGE
# python compare.py

# import the necessary packages
from skimage.measure import compare_ssim as ssim
import matplotlib.pyplot as plt
import numpy as np
import cv2

def mse(imageA, imageB):
	# the 'Mean Squared Error' between the two images is the
	# sum of the squared difference between the two images;
	# NOTE: the two images must have the same dimension
	err = np.sum((imageA.astype("float") - imageB.astype("float")) ** 2)
	err /= float(imageA.shape[0] * imageA.shape[1])
	
	# return the MSE, the lower the error, the more "similar"
	# the two images are
	return err

def compare_images(imageA, imageB, title):
	# compute the mean squared error and structural similarity
	# index for the images
	m = mse(imageA, imageB)
	s = ssim(imageA, imageB)

	# setup the figure
	fig = plt.figure(title)
	plt.suptitle("MSE: %.2f, SSIM: %.2f" % (m, s))

	# show first image
	ax = fig.add_subplot(1, 2, 1)
	plt.imshow(imageA, cmap = plt.cm.gray)
	plt.axis("off")

	# show the second image
	ax = fig.add_subplot(1, 2, 2)
	plt.imshow(imageB, cmap = plt.cm.gray)
	plt.axis("off")

	# show the images
	plt.show()

# load the images -- the original, the original + contrast,
# and the original + photoshop
nongtrai = cv2.imread("images/1.jpg")
quantri = cv2.imread("images/4.jpg")
quantri1 = cv2.imread("images/4_1.jpg")
quantri2 = cv2.imread("images/4_2.jpg")

# convert the images to grayscale
nongtrai = cv2.cvtColor(nongtrai, cv2.COLOR_BGR2GRAY)
quantri = cv2.cvtColor(quantri, cv2.COLOR_BGR2GRAY)
quantri1 = cv2.cvtColor(quantri1, cv2.COLOR_BGR2GRAY)
quantri2 = cv2.cvtColor(quantri2, cv2.COLOR_BGR2GRAY)

# initialize the figure
fig = plt.figure("Images")
images = ("chuyen-o-nong-trai", nongtrai), ("co-nang-quan-tri", quantri), ("co-nang-quan-tri", quantri1), ("co-nang-quan-tri", quantri2)

# loop over the images
for (i, (name, image)) in enumerate(images):
	# show the image
	ax = fig.add_subplot(1, 4, i + 1)
	ax.set_title(name)
	plt.imshow(image, cmap = plt.cm.gray)
	plt.axis("off")

# show the figure
plt.show()

# compare the images
compare_images(nongtrai, quantri, "Different")
compare_images(quantri, quantri1, "Similar")
compare_images(quantri, quantri2, "Similar")
compare_images(quantri1, quantri2, "Similar")
