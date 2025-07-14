# Variables
APP_NAME=microdonne
PHP=php
COMPOSER=composer
#NPM=npm
ARTISAN=$(PHP) artisan

# Cibles par défaut
.DEFAULT_GOAL := help

# Aide
help:
	@echo ""
	@echo "=== Makefile pour le projet $(APP_NAME) ==="
	@echo "Commandes disponibles :"
	@echo "  make install        : Installe les dépendances PHP et JS"
	@echo "  make migrate        : Exécute les migrations Laravel"
	@echo "  make seed           : Remplit la base avec les seeders"
	@echo "  make serve          : Lance le serveur Laravel"
	@echo "  make dev            : Compile les assets (développement)"
	@echo "  make prod           : Compile les assets (production)"
	@echo "  make test           : Lance les tests"
	@echo "  make fresh          : Reset + migrate + seed"
	@echo "  make clean          : Supprime les fichiers générés"
	@echo ""

# Installation des dépendances
install:
	$(COMPOSER) install
#$(NPM) install

# Lancement du serveur Laravel
serve:
	$(ARTISAN) serve

# Migrations et Seeders
migrate:
	$(ARTISAN) migrate


.PHONY: help install migrate  serve 
