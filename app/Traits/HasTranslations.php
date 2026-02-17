<?php

namespace App\Traits;

use Illuminate\Support\Facades\App;

trait HasTranslations
{
    /**
     * Get the translated value of an attribute.
     *
     * @param string $key
     * @return mixed
     */
    public function getAttribute($key)
    {
        if ($this->isTranslatableAttribute($key)) {
            return $this->getTranslation($key, App::getLocale());
        }

        return parent::getAttribute($key);
    }

    /**
     * Get the translated value of an attribute for a specific locale.
     *
     * @param string $key
     * @param string|null $locale
     * @return string
     */
    public function getTranslation($key, $locale = null)
    {
        $value = parent::getAttribute($key);
        $translations = is_string($value) ? json_decode($value, true) : $value;
        $locale = $locale ?: App::getLocale();
        $fallbackLocale = config('app.fallback_locale', 'fr');

        if (isset($translations[$locale]) && !empty($translations[$locale])) {
            return $translations[$locale];
        }

        if (isset($translations[$fallbackLocale]) && !empty($translations[$fallbackLocale])) {
            return $translations[$fallbackLocale];
        }

        return !empty($translations) && is_array($translations) ? (string)reset($translations) : '';
    }

    /**
     * Determine if an attribute is translatable.
     *
     * @param string $key
     * @return bool
     */
    protected function isTranslatableAttribute($key)
    {
        return isset($this->translatable) && in_array($key, $this->translatable);
    }
    
    /**
     * Set a translation for an attribute.
     * 
     * @param string $key
     * @param string $locale
     * @param mixed $value
     * @return $this
     */
    public function setTranslation($key, $locale, $value)
    {
        $translations = $this->getRawOriginal($key);
        $translations = is_string($translations) ? json_decode($translations, true) : ($translations ?? []);
        
        $translations[$locale] = $value;
        
        $this->attributes[$key] = json_encode($translations);
        
        return $this;
    }

    /**
     * Set a given attribute on the model.
     *
     * @param string $key
     * @param mixed $value
     * @return mixed
     */
    public function setAttribute($key, $value)
    {
        if ($this->isTranslatableAttribute($key) && !is_array($value)) {
            return $this->setTranslation($key, App::getLocale(), $value);
        }

        return parent::setAttribute($key, $value);
    }
}
