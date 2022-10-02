import React from 'react';
import { View, StyleSheet } from 'react-native';
import Constants from 'expo-constants';
import { useNetInfo } from '@react-native-community/netinfo';

import AppText from './Text';
import colors from '../config/colors';

function OfflineNotice(props) {
  const netInfo = useNetInfo();
  console.log(netInfo);

    if(netInfo.type !== "unknown" && netInfo.isInternetReachable === false)
    return (
        <View style={styles.container}>
          <AppText style={styles.text}>No Internet Connection</AppText>
        </View>
    );

    return null;
}

const styles = StyleSheet.create({
    container: {
      alignItems: 'center',
      backgroundColor: colors.primary,
      height: 50,
      justifyContent: 'center',
      position: "absolute",
      top: Constants.statusBarHeight,
      zIndex: 1,
      width: '100%',
    },
    text: {
      color: colors.white,
    }
})

export default OfflineNotice;