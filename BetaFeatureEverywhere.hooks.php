<?php

class BetaFeatureEverywhereHooks {

	/**
	* Handler for UserLoadOptions
	* @param User $user
	* @param array $options
	* @return array $options
	*/
	static function everywhere( $user, &$options) {
		global $wgDefaultUserOptions, $wgHiddenPrefs, $wgBetaFeaturesEverywhere;

		$features = array(
			'betafeatures-vector-compact-personal-bar',
			'betafeatures-vector-typography-update',
			'betafeatures-vector-fixedheader',
			'visualeditor-enable',
			'popups',
		);

		if(isset($wgBetaFeaturesEverywhere) && is_array($wgBetaFeaturesEverywhere)) {
			$features = array_merge($wgBetaFeaturesEverywhere, $features);
		}

		foreach($features as $feature) {

			if( isset($wgDefaultUserOptions[$feature]) ) {

				// Set feature on/off for also logged in users
				$options[$feature] = $wgDefaultUserOptions[$feature];

				// Hide feature from preferences
				$wgHiddenPrefs[] = $feature;
			}

		}

		return $options;
	}

}
