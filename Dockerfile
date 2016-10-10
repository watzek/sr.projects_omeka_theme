FROM watzek/omeka
MAINTAINER Nick Budak <budak@lclark.edu>

# Build-time metadata as defined at http://label-schema.org
ARG BUILD_DATE
ARG VCS_REF
LABEL org.label-schema.build-date=$BUILD_DATE \
      org.label-schema.docker.dockerfile="/Dockerfile" \
      org.label-schema.license="Apache" \
      org.label-schema.vcs-ref=$VCS_REF \
      org.label-schema.vcs-type="Git" \
      org.label-schema.vcs-url="https://github.com/WatzekDigitalInitiatives/sr.projects_omeka_theme"

# Add in the theme files
WORKDIR /var/www/Omeka/themes/
RUN git clone https://github.com/WatzekDigitalInitiatives/sr.projects_omeka_theme.git srprojects-theme
RUN chown -R root.www-data srprojects-theme && chmod -R 775 srprojects-theme
