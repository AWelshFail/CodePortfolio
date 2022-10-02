import React, { useEffect } from 'react';
import { View, StyleSheet, Image, TouchableWithoutFeedback, Alert, Linking } from 'react-native';
import * as ImagePicker from 'expo-image-picker';
import { MaterialCommunityIcons } from '@expo/vector-icons';

import colors from '../config/colors';

function ImageInput({imageUri, onChangeImage}) {
    useEffect(() => {
        requestPermission();
    }, []);

    const requestPermission = async () => {
    
        const { granted } = await ImagePicker.requestMediaLibraryPermissionsAsync
    if (!granted)
        //alert('You need to enable permission to access the libary');
        
        Alert.alert('Permissions', 'You need to enable permission to access the libary, do you want to open settings?', [
            { text: 'Yes', onPress: () => Linking.openSettings() },
            { text: 'No'},
        ])
    }
    
    const handlePress = () =>{
        if (!imageUri) {
            selectImage();
        }else{
            Alert.alert('Delete', 'Are you sure you want to delete this image', [
                { text: 'Yes', onPress: () => onChangeImage(null) },
                { text: 'No'},
            ])
        }
    };

    const selectImage = async () => {
        try {
          const result = await ImagePicker.launchImageLibraryAsync({
            mediaTypes: ImagePicker.MediaTypeOptions.Images,
            quality: 0.5,
          });
          if (!result.cancelled){
            onChangeImage(result.uri);
          }
        } catch (error) {
          console.log("Error while reading image " + error)
        }
        
      };
    
    return (
        <TouchableWithoutFeedback onPress={handlePress}>
             
        <View style={styles.container}>
            {!imageUri && <MaterialCommunityIcons color={colors.mediumG} name={"camera"} size={40}/>}
            {imageUri && <Image source={{ uri: imageUri}} style={styles.image} />}
        </View>
        </TouchableWithoutFeedback>
    );
}

const styles = StyleSheet.create({
    container: {
        alignItems:"center",
        backgroundColor: colors.light,
        borderRadius: 15,
        height: 100,
        justifyContent: "center",
        overflow:"hidden",
        width: 100,
        

    },
    image: {
        height: "100%",
        width: "100%",
    }
})

export default ImageInput;