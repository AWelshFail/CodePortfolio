import React from 'react';
import { View, StyleSheet, KeyboardAvoidingView, Platform, Keyboard, } from 'react-native';
import {Image} from 'react-native-expo-image-cache';

import Text from '../components/Text';
import colors from '../config/colors' 
import { ListItem } from '../components/lists';


function ListingDetailsScreen({route}) {
    const listing = route.params;
    
    return (
    <KeyboardAvoidingView
      behavior="position"
      keyboardVerticalOffset={Platform.OS === "ios" ? 0 : 100}
    >
            <Image style={styles.image} preview={{uri: listing.images[0].thumbnailUrl}} tint="light" uri={listing.images[0].url} />
        <View>
            <View style={styles.detailsContainer}>
            <Text style={styles.title}>{listing.title}</Text>
            <Text style={styles.price}>£{listing.price}</Text>
            <View style={styles.userContainer}>
            <ListItem image={require("../assets/mosh.jpg")} title="Edward Meek" subTitle="5 listings"/>                
            </View>
            </View>
        </View>
    </KeyboardAvoidingView>
    );
}

const styles = StyleSheet.create({
    detailsContainer: {
        padding:20,
    },
    image: {
        width: '100%',
        height: 300,
   },
   title: {
    fontSize:25,
    fontWeight: "500",
   },
   price:{
    color: colors.secondary,
    fontWeight: "bold",
    fontSize: 20,
    marginTop:10
   },
   userContainer: {
    marginTop: 20,
   }
})

export default ListingDetailsScreen;