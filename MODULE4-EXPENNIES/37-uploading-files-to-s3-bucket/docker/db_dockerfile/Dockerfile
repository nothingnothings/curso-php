FROM mysql:8.0

# Remove the existing mysql user
RUN userdel mysql || true

# Create a new mysql user (optional)
RUN useradd mysql || true

# Create a directory for MySQL data
RUN mkdir -p /Users/me/docker/mysql/data

# Set permissions for the directory
RUN chmod -R 777 /Users/me/docker/mysql/data