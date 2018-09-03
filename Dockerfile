# Use an official Python runtime as a parent image
FROM ubuntu:14.04
# Set the working directory to /app
WORKDIR /projects
#Poner todos los archivos en /projects/nasana
# ADD . /projects/nasana
# Copy the current directory contents into the container at /app
ADD . /var/www/html/
# Instala apache
RUN apt-get install -y apache2

#Run apache on foreground
CMD apachectl -D FOREGROUND
#Removing current index.html
RUN rm /var/www/html/index.html

# Make port 80 available to the world outside this container
# EXPOSE 80

# Define environment variable
# ENV NAME World

# Run app.py when the container launches
# CMD ["python", "app.py"]
