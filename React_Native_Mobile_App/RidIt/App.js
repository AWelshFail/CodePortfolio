import React, {  useState } from "react";
import NetInfo, { useNetInfo } from '@react-native-community/netinfo';
import AsyncStorage from '@react-native-async-storage/async-storage';

import AppLoading from 'expo-app-loading';

import { Button, Text } from "react-native";
import { createNativeStackNavigator } from '@react-navigation/native-stack';
import { createBottomTabNavigator } from '@react-navigation/bottom-tabs';
import { NavigationContainer, useNavigation, DefaultTheme} from '@react-navigation/native';
import { MaterialCommunityIcons } from '@expo/vector-icons';

import Screen from "./app/components/Screen";
import AuthNavigator from "./app/navigation/AuthNavigator";
import authStorage from './app/auth/storage';
import navigationTheme from "./app/navigation/navigationTheme";
import AppNavigator from "./app/navigation/AppNavigator";
import colors from "./app/config/colors";
import OfflineNotice from "./app/components/OfflineNotice";
import AuthContext from "./app/auth/context";
import { navigationRef } from "./app/navigation/rootNavigation";



export default function App() {
  const [user, setUser] = useState();
  const [isReady, setIsReady] = useState(false);

  const restoreUser = async () => {
    const user = await authStorage.getUser();
    if(user) setUser(user);    
  };

  if(!isReady) 
    return (
      <AppLoading startAsync={restoreUser} onFinish={() => setIsReady(true) } onError={console.warn} />);
  
  

  return (
    <AuthContext.Provider value={{ user, setUser }}>
      <OfflineNotice />
      <NavigationContainer ref={navigationRef} theme={navigationTheme} >
        {user ? <AppNavigator /> : <AuthNavigator />}
      </NavigationContainer>
    </AuthContext.Provider>
  );
}
