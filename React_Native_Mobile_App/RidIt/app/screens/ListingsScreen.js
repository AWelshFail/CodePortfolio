import React, { useState, useEffect } from "react";
import { FlatList, StyleSheet } from "react-native";


import ActivityIndicator from "../components/ActivityIndicator.js";
import AppText from "../components/AppText/AppText";
import Button from "../components/Button";
import listingsApi from "../api/listings";
import Card from "../components/Card";
import colors from "../config/colors";
import Screen from "../components/Screen";
import routes from "../navigation/routes";
import useApi from "../hooks/useApi.js";

// const listings = [
//   {
//     id: 1,
//     title: "Red jacket for sale",
//     price: 100,
//     image: require("../assets/jacket.jpg"),
//   },
//   {
//     id: 2,
//     title: "Couch in great condition",
//     price: 1000,
//     image: require("../assets/couch.jpg"),
//   },
// ];



function ListingsScreen({ navigation }) {
  // const [listings, setListings] = useState([]);
  // const [error, setError] = useState([false]);
  // const [loading, setLoading] = useState(false);
  const {request: loadListings, data: listings, error, loading} = useApi(listingsApi.getListings);
  useEffect(() => {
    loadListings();
  }, []);

  // const loadListings = async () => {
  //   setLoading(true);
  //   const response = await listingsApi.getListings();
  //   setLoading(false)

  //   if ( !response.ok ) {
      
  //     return setError( true );
  //   };

  //   setError(false); 
  //   setListings(response.data);
  // };

  return (
    <>
    <ActivityIndicator visible={loading} />
    <Screen style={styles.screen}>
      { error && (<>
        <AppText>Couldnt retrive listings</AppText>
        <Button title="Retry" onPress={loadListings}/>
      </>
      )}
      <FlatList
        data={listings}
        keyExtractor={(listing) => listing.id.toString()}
        renderItem={({ item }) => (
          <Card
            title={item.title}
            subTitle={"£" + item.price}
            imageUrl={item.images[0].url}
            onPress={() => navigation.navigate(routes.LISTING_DETAILS, item)}
            thumbnailUrl={item.images[0].thumbnailUrl}
            
          />
        )}
      />
    </Screen>
    </>
  );
}

const styles = StyleSheet.create({
  screen: {
    padding: 20,
    paddingBottom: 0,
    backgroundColor: colors.light,
  },
});

export default ListingsScreen;
